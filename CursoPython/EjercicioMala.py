#determinar cuantos meses han empezado en un domingo desde 1900 hasta 2000 

#parametros cantidad de dias 365 por año y cada 4 años un dia mas en febrero, 12 meses, matriz de meses 
#claves
# #int(matriz[i]/(len(matriz1)+1))+1 
año1=1900
año2=2001
semanas=4
h=0
f=6   #inicio de año
b=0
t=0
bolea=False
count=0
año=año2-año1
añoN=(31,28,31,30,31,30,31,31,30,31,30,31)
añoB=(31,29,31,30,31,30,31,31,30,31,30,31)
matriz1=("lunes","martes","miercoles","jueves","viernes","sabado","domingo")

for r in range (año):
    y=(r)-(b*4)
    #print("/////////////////////////////////////////////////////año: "+str(r))
    if y==0:
        matriz=añoB
    elif (y/4)==1:
        b=b+1
        bolea=True  
        matriz=añoB
        #print("año biciesto")
        t=1
    else : 
        matriz=añoN
        bolea=False
        t=0
    for i in range (len(matriz)):
        for j in range (matriz[i]):             
            h=j+1+f+t
            if t==1:
                t=0
            if 7< h < 15:
                h= h-7 
            elif 15 <= h < 22:
                h=h-14
            elif 22 <= h < 29:
                h=h-21
            elif 29 <= h <36:
                h=h-28
            elif 36 <= h < 40:
                h=h-(28+7)
            h=h-1
            #eprint((j+1))
            #print(h)
            diaact=matriz1[h]    
            #print(diaact)
        
        f=matriz1.index(diaact)+1
        if matriz1[matriz1.index(diaact)]==matriz1[5]:
            count += 1
print("la cantidad de meses que empiezan en domingo son:"+str(count))

    
    
#referencia un año referencia para determinar cuantos meses han sido domingo
#año 2000 empezo con lunes 

#cada 4 años bucle 
