#! / bin / pytho3..

##
# complete la funcion 'fizzbuzz' a continuacion.
# #
#La funcion aceta integer n como parametro
##
def fizzbuzz (n):
    #escriba su codigo aqui
    
    for i in range (n):
        numero=i+1
        print(str(numero)+" : ", end="")
        if numero%3 + numero%5 == 00 :
            print("fizzbuzz")            
        elif numero%3 == 0 :
            print("fizz")
        elif numero%5 == 0 :
            print("buzz")
        else: 
            print("no es multiplo de 3 y 5")
            
n=int(input("ingrese un numero mayor a 1: "))
fizzbuzz(n)
if __name__=='__name=__':
    main()