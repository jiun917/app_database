import sys
import pandas as pd
import numpy as np
import json
from sklearn import linear_model


ta = int(sys.argv[1])

day = 0
time = 12
shop = 1
if shop == 1:
    goods = [2, 3, 5, 7, 9, 11, 13, 17, 21, 23, 26]  # 餐點
    if day == 0:
        days = [3, 5, 5, 3, 2, 2, 3, 5, 5, 3, 2]  # 平日
    else:
        days = [3, 5, 5, 3, 2, 2, 3, 5, 5, 3, 2]  # 假日

    types = [5, 11, 9, 7, 5, 3, 7, 12, 15, 10, 5]  # 單量

    if time == 11:
        moments = [8, 13, 13, 11, 3, 3, 6, 13, 17, 10, 6]
    elif time == 12:
        moments = [12, 17, 17, 15, 7, 7, 9, 17, 21, 14, 10]
    elif time == 13:
        moments = [10, 15, 15, 13, 5, 5, 8, 15, 19, 12, 8]
    elif time == 14:
        moments = [8, 13, 13, 11, 3, 3, 6, 13, 17, 10, 6]
    elif time == 15:
        moments = [7, 12, 12, 10, 2, 2, 5, 12, 16, 9, 5]
    elif time == 16:
        moments = [7, 12, 12, 10, 2, 2, 5, 12, 16, 9, 5]
    elif time == 17:
        moments = [8, 13, 13, 11, 3, 3, 6, 13, 17, 10, 6]
    elif time == 18:
        moments = [12, 17, 17, 15, 7, 7, 9, 17, 21, 14, 10]
    elif time == 19:
        moments = [12, 17, 17, 15, 7, 7, 9, 17, 21, 14, 10]
    elif time == 20:
        moments = [10, 15, 15, 13, 5, 5, 8, 15, 19, 12, 8]
    elif time == 21:
        moments = [7, 12, 12, 10, 2, 2, 5, 12, 16, 9, 5]

    wait = [3, 5, 7, 9, 11, 13, 15, 17, 19, 21, 25]  # 時間
elif shop == 2:
    goods = [2, 3, 5, 7, 9, 11, 13, 17, 21, 23, 26]  # 餐點
    if day == 0:
        days = [3, 5, 5, 3, 2, 2, 3, 5, 5, 3, 2]  # 平日
    else:
        days = [3, 5, 5, 3, 2, 2, 3, 5, 5, 3, 2]  # 假日

    types = [5, 11, 9, 7, 5, 3, 7, 12, 15, 10, 5]  # 單量

    if time == 11:
        moments = [8, 13, 13, 11, 3, 3, 6, 13, 17, 10, 6]
    elif time == 12:
        moments = [12, 17, 17, 15, 7, 7, 9, 17, 21, 14, 10]
    elif time == 13:
        moments = [10, 15, 15, 13, 5, 5, 8, 15, 19, 12, 8]
    elif time == 14:
        moments = [8, 13, 13, 11, 3, 3, 6, 13, 17, 10, 6]
    elif time == 15:
        moments = [7, 12, 12, 10, 2, 2, 5, 12, 16, 9, 5]
    elif time == 16:
        moments = [7, 12, 12, 10, 2, 2, 5, 12, 16, 9, 5]
    elif time == 17:
        moments = [8, 13, 13, 11, 3, 3, 6, 13, 17, 10, 6]
    elif time == 18:
        moments = [12, 17, 17, 15, 7, 7, 9, 17, 21, 14, 10]
    elif time == 19:
        moments = [12, 17, 17, 15, 7, 7, 9, 17, 21, 14, 10]
    elif time == 20:
        moments = [10, 15, 15, 13, 5, 5, 8, 15, 19, 12, 8]
    elif time == 21:
        moments = [7, 12, 12, 10, 2, 2, 5, 12, 16, 9, 5]

    wait = [3, 5, 7, 9, 11, 13, 15, 17, 19, 21, 25]  # 時間
elif shop == 3:
    goods = [2, 3, 5, 7, 9, 11, 13, 17, 21, 23, 26]  # 餐點
    if day == 0:
        days = [3, 5, 5, 3, 2, 2, 3, 5, 5, 3, 2]  # 平日
    else:
        days = [3, 5, 5, 3, 2, 2, 3, 5, 5, 3, 2]  # 假日

    types = [5, 11, 9, 7, 5, 3, 7, 12, 15, 10, 5]  # 單量

    if time == 11:
        moments = [8, 13, 13, 11, 3, 3, 6, 13, 17, 10, 6]
    elif time == 12:
        moments = [12, 17, 17, 15, 7, 7, 9, 17, 21, 14, 10]
    elif time == 13:
        moments = [10, 15, 15, 13, 5, 5, 8, 15, 19, 12, 8]
    elif time == 14:
        moments = [8, 13, 13, 11, 3, 3, 6, 13, 17, 10, 6]
    elif time == 15:
        moments = [7, 12, 12, 10, 2, 2, 5, 12, 16, 9, 5]
    elif time == 16:
        moments = [7, 12, 12, 10, 2, 2, 5, 12, 16, 9, 5]
    elif time == 17:
        moments = [8, 13, 13, 11, 3, 3, 6, 13, 17, 10, 6]
    elif time == 18:
        moments = [12, 17, 17, 15, 7, 7, 9, 17, 21, 14, 10]
    elif time == 19:
        moments = [12, 17, 17, 15, 7, 7, 9, 17, 21, 14, 10]
    elif time == 20:
        moments = [10, 15, 15, 13, 5, 5, 8, 15, 19, 12, 8]
    elif time == 21:
        moments = [7, 12, 12, 10, 2, 2, 5, 12, 16, 9, 5]

    wait = [3, 5, 7, 9, 11, 13, 15, 17, 19, 21, 25]  # 時間

series_dict = {'x1': goods, 'x2': days, 'x3': types, 'x4': moments, 'y': wait}
df = pd.DataFrame(series_dict)
x = df[['x1', 'x2', 'x3', 'x4']]
y = df[['y']]

regr = linear_model.LinearRegression()
regr.fit(x.values, y.values)


print(int(regr.predict(np.array([[ta, 5, 7, 15]]))))

# myDict = {
#     "total": int(regr.predict(np.array([[ta, 5, 7, 15]])))+1
# }
# print(json.dumps(myDict))