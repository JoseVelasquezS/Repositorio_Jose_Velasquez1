#utilizando for 
numf=0
numero=list()
for i in range (1,4):
    a=i-1
    #print(a)
    #if(a==1):
     #   numero=(int(input("ingrese el numero "+ str(a)+ " : "),)
    valor=int(input("ingrese el numero "+ str(i)+ " : "))
    numero.append(valor)
    #numero[i]=numero[a]
    ##imprimir la consecucion delos numeros 
    #print(numero)
    #print(numero[a])
    numf=numf+numero[a]

aritmetica=float(numf/len(numero))

print("la media aritmetica es ", aritmetica) 
