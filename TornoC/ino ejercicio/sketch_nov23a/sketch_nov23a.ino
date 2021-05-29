#include <Stepper.h>
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
//-----Declaramos las entradas(Botones)
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
