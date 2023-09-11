#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

const char* ssid = "ZemistTK";
const char* password = "11111111";
const char* serverAddress = "http://192.168.7.128/ct324_miniproject/action/get_value.php";

WiFiClient wifiClient; // Create a WiFiClient object

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
}

void loop() {
  int sensorValue1 = analogRead(A0);
  int sensorValue2 = analogRead(5);
  Serial.println("Sensor Value 1: " + String(sensorValue1));
  Serial.println("Sensor Value 2: " + String(sensorValue2));

  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    String postData = "sensor_value1=" + String(sensorValue1) + "&sensor_value2=" + String(sensorValue2);
    http.begin(wifiClient, serverAddress); // Use the wifiClient object

    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    int httpResponseCode = http.POST(postData);

    if (httpResponseCode > 0) {
      Serial.print("HTTP Response Code: ");
      Serial.println(httpResponseCode);
    } else {
      Serial.println("Error sending POST request");
    }

    http.end();
  }

  delay(5000); // Delay for 5 seconds before sending the next reading
}
