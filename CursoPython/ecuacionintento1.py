# Enter your code here. Read input from STDIN. Print output to STDOUT
objeto=input()
formula=input()
formula1=formula.split(" + ")
x=0
k=0
b=0
for i in range(len(formula1)-1,len(formula1)):
    b= int(formula1[i])
objeto1=objeto.split(" ")
x=int(objeto1[0])
k=int(objeto1[1])
polinomio=list()
ecuacion=list()
ecuacion1=int()
for i in formula1:
    for j in i: 
        if j != "*" :
            polinomio.append(j)
for i in range(0, len(polinomio)-1):
    ecuacion.append(polinomio[i])
for i in ecuacion:
    if i != "x":
        ecuacion1 += (x ** int(i))
ecuacion1 = ecuacion1 + x + b
if ecuacion1 == k:
    print(True)
else:
    print ( False)