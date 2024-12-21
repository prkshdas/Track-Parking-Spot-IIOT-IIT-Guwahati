#include <ESP8266WiFi.h>
#include <DHT.h>

// DHT11 Sensor Configuration
#define DHTPIN D5       
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

// Ultrasonic Sensor Pins
#define TRIG_PIN_1 D4
#define ECHO_PIN_1 D3
#define TRIG_PIN_2 D6
#define ECHO_PIN_2 D7
#define TRIG_PIN_3 D8
#define ECHO_PIN_3 D2
#define TRIG_PIN_4 D1
#define ECHO_PIN_4 D0

// Wi-Fi credentials
const char* ssid = "839";
const char* password = "8399009050";

// Server address
const char* server = "192.168.214.190";  
const int port = 3000;

// Function to read distance from ultrasonic sensors
long readDistance(int trigPin, int echoPin) {
    digitalWrite(trigPin, LOW);
    delayMicroseconds(2);
    digitalWrite(trigPin, HIGH);
    delayMicroseconds(10);
    digitalWrite(trigPin, LOW);

    long duration = pulseIn(echoPin, HIGH);
    long distance = (duration / 2) / 29.1;  // Convert duration to cm
    return distance;
}

void setup() {
    Serial.begin(115200);
    WiFi.begin(ssid, password);

    // Connect to Wi-Fi
    Serial.print("Connecting to Wi-Fi");
    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }
    Serial.println("Connected!");
    
    // Initialize DHT sensor
    dht.begin();

    // Set ultrasonic sensor pins
    pinMode(TRIG_PIN_1, OUTPUT);
    pinMode(ECHO_PIN_1, INPUT);
    pinMode(TRIG_PIN_2, OUTPUT);
    pinMode(ECHO_PIN_2, INPUT);
    pinMode(TRIG_PIN_3, OUTPUT);
    pinMode(ECHO_PIN_3, INPUT);
    pinMode(TRIG_PIN_4, OUTPUT);
    pinMode(ECHO_PIN_4, INPUT);
}

void loop() {
    // Read distances from all ultrasonic sensors
    long distance1 = readDistance(TRIG_PIN_1, ECHO_PIN_1);
    long distance2 = readDistance(TRIG_PIN_2, ECHO_PIN_2);
    long distance3 = readDistance(TRIG_PIN_3, ECHO_PIN_3);
    long distance4 = readDistance(TRIG_PIN_4, ECHO_PIN_4);

    // Read temperature and humidity from DHT11
    float temp = dht.readTemperature();
    float hum = dht.readHumidity();

    // Check if DHT sensor readings failed
    if (isnan(temp) || isnan(hum)) {
        Serial.println("Failed to read from DHT sensor!");
        return;
    }

    // Determine parking statuses based on distances
    String parkingStatus1 = (distance1 < 10) ? "Occupied" : "Available";
    String parkingStatus2 = (distance2 < 10) ? "Occupied" : "Available";
    String parkingStatus3 = (distance3 < 10) ? "Occupied" : "Available";
    String parkingStatus4 = (distance4 < 10) ? "Occupied" : "Available";

    // Prepare data to send to the server
    String postData = "temperature=" + String(temp) + 
                      "&humidity=" + String(hum) + 
                      "&parking_status_1=" + parkingStatus1 + 
                      "&parking_status_2=" + parkingStatus2 + 
                      "&parking_status_3=" + parkingStatus3 + 
                      "&parking_status_4=" + parkingStatus4;

    Serial.println(postData);

    // Send data to the server
    WiFiClient client;
    if (client.connect(server, port)) {
        client.println("POST /send-data HTTP/1.1");
        client.println("Host: " + String(server));
        client.println("Content-Type: application/x-www-form-urlencoded");
        client.print("Content-Length: ");
        client.println(postData.length());
        client.println();
        client.print(postData);
    } else {
        Serial.println("Connection to server failed.");
    }

    delay(5000);
}
