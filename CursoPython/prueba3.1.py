def reposicion (itemCount, targe):
    total=0
    for i in range (len(itemCount)):
        total =total + itemCount[i]
    UnidAdic=targe-total
    return UnidAdic

itemCount=(6,1,2,1)
print("EL item Count del provedor primario es :"+ str(itemCount))
objetivo=int(input("ingrese el valor del objetivo: "))
print("el Gerente debe comrpar: "+ str(reposicion(itemCount, objetivo))+ " undiades adiacionales.")
if __name__ ==  '__name__':
    main()