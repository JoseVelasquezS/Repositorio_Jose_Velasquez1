from datetime import datetime, timedelta
formatofecha = "%d/%m/%Y"
contador = 0           
fechadesde = "01/01/1901"
fechahasta = "31/12/2000"
try:                    
    fechadesde = datetime.strptime(fechadesde, formatofecha)
    fechahasta = datetime.strptime(fechahasta, formatofecha)
    while fechadesde <= fechahasta:
        fechadesde = fechadesde + timedelta(days=1)
        if datetime.weekday(fechadesde) == 6: 
            fechaactual = fechadesde.strftime(formatofecha)
            fechaactual = fechaactual.find("01")
            if fechaactual == 0:
                contador += 1
    print (contador, "Meses han empezado un domingo comprendido entre 01/01/1901 a 1/12/2000") 
except:
    print('ERROR')
