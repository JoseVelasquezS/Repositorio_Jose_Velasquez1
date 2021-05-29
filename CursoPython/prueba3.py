def reposicion (itemCount, targe):
    total=0
    for i in range (len(itemCount)):
        total =total + itemCount[i]
    UnidAdic=targe-total
    return UnidAdic

art=int(input("ingrese la cantidad de articulos del provedor primario (numero entero): "))
itemCount=list()
for i in range(art):
    num=int(input("ingrese la cantidad para el articulo "+ str(i+1) + " : "))
    itemCount.append(num) 
print("el item Count de provedor primarios es:" + str(itemCount))
objetivo=int(input("ingrese el valor del objetivo: "))
print("el Gerente debe comrpar: "+ str(reposicion(itemCount, objetivo))+ " undiades adiacionales.")
if __name__ ==  '__name__':
    main()