import json
import sys
import cv2
import base64, time, os


recognizer = cv2.face.LBPHFaceRecognizer_create()
recognizer.read(r'C:\xampp\htdocs\app_database\Python\face\pic\test.yml')

try:
    pic = sys.argv[1]
except:
    print("ERROR")
    sys.exit(1)
    
img = cv2.imread(fr'C:\xampp\htdocs\app_database\Python\face\pic\{pic}')

gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
face_detector = cv2.CascadeClassifier(r'C:\xampp\htdocs\opencv\sources\data\haarcascades\haarcascade_frontalface_default.xml')
faces = face_detector.detectMultiScale(gray, scaleFactor=1.1, minNeighbors=3)

for x, y, w, h in faces:
    cv2.rectangle(img, (x, y), (x + w, y + h), color=(0, 255, 0), thickness=3)
    id, confidence = recognizer.predict(gray[y:y+h, x:x+w])

if confidence <= 50:
    print(1)
else:
    print(0)

fileTest = fr'C:\xampp\htdocs\app_database\Python\face\pic\{pic}'
# os.remove(fileTest)

    
