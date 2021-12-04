#include <Bridge.h>
#include <BridgeClient.h>
#include <DHT.h>
#include <Console.h>

#define DHTTYPE DHT11

struct str_dht{
  const char *sensorName;
  float humidity;
  float tempCelsus;
  float tempFahrenheit;
  float heatIndexCelsus;
  float heatIndexFahrenheit;
  float dewPoint;
};

BridgeClient client;
DHT dht01(2, DHTTYPE);
DHT dht02(3, DHTTYPE);

const char *ip="145.14.151.37";
//const char *ip="192.168.1.63";
const char *sensorName_01="DHT11_PIN2";
const char *sensorName_02="DHT11_PIN3";

void setup()
{
  Bridge.begin();
  //Console.begin();
  //while(!Console);
  dht01.begin();
  dht02.begin();
  
  Console.println("Connexion hôte établie !");
}

void loop()
{
  client.connect(ip,80);
  
  if(client.connected())
  {    
     str_dht *d01 = DHTcollection(dht01, sensorName_01);
     String s01 = DHTtoPOSTformat(d01);
     DHTtransmission(s01);
     //Console.println(s01);
     
     str_dht *d02 = DHTcollection(dht02, sensorName_02);
     String s02 = DHTtoPOSTformat(d02);
     DHTtransmission(s02);

     free(d01);
     free(d02);
     unsigned long timeout = millis();
     while(client.available() == 0){
        if(millis() - timeout > 10000){
            //Console.println(">>> Client Timeout !");
            client.stop();
            return;
        }
    }

    // Read all the lines of the reply from server and print them to Console
    while(client.available()) {
        String line = client.readStringUntil('\r');
        //Console.print(line);
    }
    
  }
  else
  {
    //Console.println("Connexion echouee !");
  }
  
  Console.flush();
  if(client.connected()){
    client.stop();
  }
  delay(600000); // 10 min.
}

/** **/
str_dht *DHTcollection(DHT dht, const char *sensorName)
{
  str_dht *data = (str_dht*)malloc(sizeof(*data));
  data->tempCelsus = dht.readTemperature();
  data->humidity = dht.readHumidity();
  data->tempFahrenheit = dht.readTemperature(true);
  if (isnan(data->tempCelsus) || isnan(data->humidity) || isnan(data->tempFahrenheit)){
    //Console.println("Ne peux pas lire les données DHT !");
    exit(1);
  }
  data->heatIndexFahrenheit = dht.computeHeatIndex(data->tempFahrenheit, data->humidity);
  data->heatIndexCelsus = dht.computeHeatIndex(data->tempCelsus, data->humidity, false);
  data->sensorName=sensorName;
  data->dewPoint=(dewPoint(data->tempCelsus, data->humidity));

  return data;
}

/** **/
String DHTtoPOSTformat(str_dht *data){
  String dataPost="tempCelsus="+String(data->tempCelsus)+
                  "&humidity="+String(data->humidity)+
                  "&tempFahrenheit="+String(data->tempFahrenheit)+
                  "&heatIndexFahrenheit="+String(data->heatIndexFahrenheit)+
                  "&heatIndexCelsus="+String(data->heatIndexCelsus)+
                  "&dewPoint="+String(data->dewPoint)+
                  "&sensorName="+String(data->sensorName);
  return dataPost;
}

/** **/
void DHTtransmission(String dataPost){
    client.println("POST https://samueljacquet.be/Sensor/DataCollection.php HTTP/1.1");
    //client.println("POST http://localhost/MonSiteProd/Sensor/DataCollection.php HTTP/1.1");
    client.println("Host: " + String(ip));
    client.println("Content-Type: application/x-www-form-urlencoded");
    client.println("Content-Length: " + String(dataPost.length()));
    client.println();
    client.println(dataPost);
    //Console.println(dataPost);
    client.println(); // \r\n\r\n
}

/** Fonction de calcul rapide du point de rosée en fonction de la température et de l'humidité ambiante */
double dewPoint(double celsius, double humidity) {

  // Constantes d'approximation
  // Voir http://en.wikipedia.org/wiki/Dew_point pour plus de constantes
  const double a = 17.27;
  const double b = 237.7;

  // Calcul (approximation)
  double temp = (a * celsius) / (b + celsius) + log(humidity * 0.01);
  return (b * temp) / (a - temp);
}

double celsiusToFahrenheit(double celsius) {
  return 1.8 * celsius + 32;
}

double celsiusToKelvin(double celsius) {
  return celsius + 273.15;
}
