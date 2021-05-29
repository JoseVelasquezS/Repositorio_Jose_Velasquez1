# Credity
Prueba domingos en python
felipe@credyty.com
Buenas tardes para el siguiente programa estas seran las instrucciones:
1. el computador debe tener instalado python 3.8 (si no lo tiene puedes descargarlo aca para tu sistema operativo "https://www.python.org/downloads/")
2.una vez instalado debes ejecutar el IDE de python(clik izquierdo sobre el documento programaDomingos.py y seleccionar edit with IDE 3.8)
aca estara todo el codigo fuente y se procedera a compilar seleccionando a tecla f5 o bien con el raton dando clik en RUN 
3. corre el programa con f5
4 una vez compilado y ejecutado el programa saldra la cantidad de meses que han empezado un domingo comprendido entre 01/01/1901 hasta 31/12/2000
5 la respuestas son 171 meses han iniciado un domingo comprendido entre 01/01/1901 hasta 31/12/2000

FUNCIONES CLASES Y LIBRERIAS UTILIZADAS

SE IMPORTO LA LIBRERIA DATETIME
SE UTILIZO EL METODO strptime() PARA CONVERTIR UN STRING A FECHA Y SE LE APLICA UN FORMATO
SE UTILIZA LA FUNCION WHILE PARA EJEECUTAR EL CODIGO DE LA FECHA MENOR A LA MAYOR
SE UTILIZA EL METODO timedelta() PARA SUMAR DE UNO EN UNO LOS DIAS DENTRO DEL WHILE
SE UTILIZA UN if CON LA FUNCION weekday() PARA OBTENER LOS DIAS DE LA SEMANA SIENDO LUNES = 0 Y DOMINGO = 6
SE CREA UNA NUEVA VARIABLE Y SE LE ASIGNA EL FORMATO DE FECHA DENTRO DEL if
SE UTILIZA EL METODO find() PARA ENCONTRAR EN UNA POSICION LA COINCIDENCIA DE INICIO DE MES
SE UTILIZA OTRO if QUE COMPARE LA COINCIDENCIA Y SE LE ASIGNA UN CONTADOR POR ULTIMO DE UTILIZA UN print PARA MOSTRAR LA RESPUESTA Y SE USA UNA EXCEPCION 
