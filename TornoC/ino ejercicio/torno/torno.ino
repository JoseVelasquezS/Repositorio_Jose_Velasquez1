#include <Stepper.h>
int input;
// cambie este valor por el numero de pasos de su motor
const int PasosMotorPorRevolucion = 200;  
//Nombramos a las entradas:
#define Entrada1  2
#define Entrada2  3
#define Entrada3  4
#define Entrada4  5
//Declaramos los pines de salidas de los motores:
Stepper PAP1(PasosMotorPorRevolucion, 6,7,8,9);     
Stepper PAP2(PasosMotorPorRevolucion, 13,12,11,10);     
void setup() {
//-----Decalramos las entradas(Botones)
//EJE X
pinMode(Entrada1, INPUT);
pinMode(Entrada2, INPUT);
//EJE Y 
pinMode(Entrada3, INPUT);
pinMode(Entrada4, INPUT); 
// establece la velocidad en RPM para los motores
PAP1.setSpeed(60);
PAP2.setSpeed(60);
// inicializa el puerto serial
  Serial.begin(9600);
}

void loop() {
 if (Serial.available() > 0) {

    input = Serial.read();

    if (input == 'A'){
      for (int i = 0; i <= 100; i++) {
    
    PAP1.step(1);
    delay(20);
      
    }
    }
    if (input == 'B'){
      for (int i = 0; i <= 100; i++) {
    
    PAP1.step(-1);
    delay(20);
      
    }
      
    }
    if (input == 'C'){
      for (int i = 0; i <= 100; i++) {
    
    PAP2.step(1);
    delay(20);
      
    }
    }
    if (input == 'D'){
      for (int i = 0; i <= 100; i++) {
    
    PAP2.step(-1);
    delay(20);
      
    }
    }

 }
if (digitalRead(Entrada1)==HIGH){ Serial.println("EJE X HORARIO");
  PAP1.step(1);
  }
  if (digitalRead(Entrada2)==HIGH){ Serial.println("EJE X ANTI-HORARIO");
  PAP1.step(-1);
  }
  if (digitalRead(Entrada3)==HIGH){ Serial.println("EJE Y HORARIO");
  PAP2.step(1);
  }
  if (digitalRead(Entrada4)==HIGH){ Serial.println("EJE Y ANTI-HORARIO");
  PAP2.step(-1);
  }
}
