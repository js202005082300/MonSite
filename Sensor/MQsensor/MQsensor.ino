#define TIMER 10000 //10 sec
int LED1 = 4;
int LED2 = 3;
int buzzer = 2;
int sensorThreshold = 400;

void setup(){
  pinMode(LED1, OUTPUT);
  pinMode(LED2, OUTPUT);
  pinMode(buzzer, OUTPUT);
  
  Serial.begin(9600);
  pinMode(A0, INPUT);
}

void loop(){
  task_MQ2();
  task_MQ3();
  task_MQ4();
  task_MQ5();
}

void task_MQ2(){
  static unsigned long timeStamp = 0;
  int analogSensor = 0;
  
  if(millis() - timeStamp >= TIMER)
  {
    timeStamp += TIMER;
    int analogSensor = analogRead(A0);
    Serial.print("Pin A0/MQ2: ");
    Serial.println(analogSensor);
  }
  
  if(analogSensor > sensorThreshold)
  {
    digitalWrite(LED1, HIGH);
    digitalWrite(LED2, LOW);
    tone(buzzer, 1000, 200);
  }
  else
  {
    digitalWrite(LED1, LOW);
    digitalWrite(LED2, HIGH);
    noTone(buzzer);
  }
  delay(500);
}

void task_MQ3() {
  static unsigned long timeStamp = 0;

  if (millis() - timeStamp >= TIMER){
  timeStamp += TIMER;
  int analogSensor = analogRead(A1);
  Serial.print("Pin A1/MQ3: ");
  Serial.println(analogSensor);
  }
}

void task_MQ4() {
  static unsigned long timeStamp = 0;

  if (millis() - timeStamp >= TIMER)
  {
    timeStamp += TIMER;
    int analogSensor = analogRead(A2);
    Serial.print("Pin A2/MQ4: ");
    Serial.println(analogSensor);
  }
}

void task_MQ5() {
  static unsigned long timeStamp = 0;

  if (millis() - timeStamp >= TIMER)
  {
    timeStamp += TIMER;
    int analogSensor = analogRead(A3);
    Serial.print("Pin A3/MQ5: ");
    Serial.println(analogSensor);
  }
}
