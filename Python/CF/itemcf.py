import json
import sys
import os
import math
import operator
def main_flow():
    x = sys.argv[1]
    #獲取用戶的點擊序列數據
    user_click = get_user_click("rat.csv")
    #獲取電影信息數據
    item_info = get_item_info("good.csv")
    #計算各個物品之間的相似度
    sim_info=cal_item_sim(user_click)
    #計算每個用戶的推薦（與喜好電影相似度較高的）電影
    recom_result = cal_recom_result(sim_info, user_click)
    #根據用戶id推薦電影，此處爲“1”
    debug_recomresult(recom_result, item_info, f"{x}")

def get_user_click(rating_file):
    #如果路徑不存在，返回空數據
    if not os.path.exists(rating_file):
        return {}
    #打開文件
    fp = open(rating_file)
    num = 0
    #用於傳回的數據
    user_click={}
    #循環數據
    for line in fp:
        #第一行是表頭，需要跳過處理
        if num == 0:
            num += 1
            continue
        #根據逗號提取每個項目
        item=line.strip().split(',')
        if len(item) < 4:
            continue
        [userid, itemid, rating, timestamp] = item
        if float(rating) < 3.0:  #如果評分低於3分，則視爲該用戶不喜歡該電影
            continue
        #將單一用戶的點擊序列添加至返回數據
        if userid not in user_click:
            user_click[userid] = []
        user_click[userid].append(itemid)
    fp.close()
    return user_click

def get_item_info(item_file):
    #若路徑不存在則返回空
    if not os.path.exists(item_file):
        return {}
    num = 0
    item_info = {}
    fp = open(item_file, 'r', encoding='UTF-8')
    for line in fp:
        #第一行是表頭，需要跳過處理
        if num == 0:
            num += 1
            continue
        #根據逗號提取每個項目
        item = line.strip().split(',')
        if len(item) < 3: #若單行小於三項過濾（去除問題行）
            continue

        if len(item) == 3:
            [itemid, title, genres] = item
        #這個elif語句是由於，有的電影名稱中含有逗號，因此造成項數過多，需要另行處理
        elif len(item) > 3:
            itemid = item[0]
            genres = item[-1] #獲取最後一項
            title = ",".join(item[1:-1]) #第一個到最後一個的拼接成爲電影名稱
        #將電影信息數據返回
        if itemid not in item_info:
            item_info[itemid] = [title, genres]
    fp.close()
    return item_info

def cal_item_sim(user_click):
    # 相似度數據
    co_appear = {}
    # 用於統計每個電影的行爲用戶數量
    item_user_click_time = {}
    # 循環點擊序列數據，user是每用戶的id，itemlist是每個用戶的點擊序列
    for user, itemlist in user_click.items():
        # 循環每個用戶的點擊序列的索引
        for index_i in range(0, len(itemlist)):
            # 計算每個item的被用戶點擊數量
            itemid_i = itemlist[index_i]
            item_user_click_time.setdefault(itemid_i, 0)  # setdefault方法可以對不存在的鍵做初值設定（初始化）
            item_user_click_time[itemid_i] += 1

            # 計算每個電影id和其他電影id共同出現在一個用戶的點擊序列中的數值
            for index_j in range(index_i + 1, len(itemlist)):
                itemid_j = itemlist[index_j]

                # 計算所有電影id中，兩兩id的共同出現次數
                co_appear.setdefault(itemid_i, {})
                co_appear[itemid_i].setdefault(itemid_j, 0)
                co_appear[itemid_i][itemid_j] += base_contribute_score()  # 貢獻度，默認爲1

                co_appear.setdefault(itemid_j, {})
                co_appear[itemid_j].setdefault(itemid_i, 0)
                co_appear[itemid_j][itemid_i] += base_contribute_score()

    # 計算相似度
    item_sim_score = {}
    item_sim_score_sorted = {}
    for itemid_i, relate_item in co_appear.items():
        for itemid_j, co_time in relate_item.items():
            # 相似度計算公式
            sim_score = co_time / math.sqrt(item_user_click_time[itemid_i] * item_user_click_time[itemid_j])
            # 存儲相似度
            item_sim_score.setdefault(itemid_i, {})
            item_sim_score[itemid_i][itemid_j] = sim_score
    # 對相似度進行排序
    for itemid in item_sim_score:
        item_sim_score_sorted[itemid] = sorted(item_sim_score[itemid].items(), key=operator.itemgetter(1), reverse=True)

    return item_sim_score_sorted


# 基礎貢獻度得分
def base_contribute_score():
    return 1


def cal_recom_result(sim_info, user_click):
    # 選取用戶的前三個點擊電影，找尋它們的相似電影進行推薦
    recent_click_num = 3
    # 找尋與item相似度前topk的電影
    topk = 5
    # 返回的推薦信息數據
    recom_info = {}

    for user in user_click:
        # 獲取每個用戶的點擊序列
        click_list = user_click[user]
        recom_info.setdefault(user, {})
        # 選取用戶的前三個點擊電影，找尋它們的相似電影進行推薦
        for itemid in click_list[:recent_click_num]:
            if itemid not in sim_info:
                continue
            # 找尋與item相似度前topk的電影
            for itemsimzuhe in sim_info[itemid][:topk]:
                itemsimid = itemsimzuhe[0]
                itemsimscore = itemsimzuhe[1]
                recom_info[user][itemsimid] = itemsimscore

    return recom_info
def debug_recomresult(recom_result, item_info, user_id):
    #判斷id是否存在
    mydict = {}
    count = 0
    if user_id not in recom_result:
        print("invalid result")
        return
    #對排序的推薦信息進行遍歷
    for zuhe in sorted(recom_result[user_id].items(), key=operator.itemgetter(1), reverse=True):
        itemid, score = zuhe
        if itemid not in itemid:
            continue
        #輸出推薦結果
        mydict[count+1] = f"{itemid}"
        count += 1
        if (count==5):
            break
    print(json.dumps(mydict))

if __name__=="__main__":
    main_flow()
