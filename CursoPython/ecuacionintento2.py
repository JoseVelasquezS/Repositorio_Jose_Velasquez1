# Enter your code here. Read input from STDIN. Print output to STDOUT
objeto=input()
formula=input()
formula1=formula.split(" ")
x=0
g=0
b=0
suma=list()
resta=list()

for i in range(len(formula1)-1,len(formula1)):
    b= int(formula1[i])
objeto1=objeto.split(" ")
x1=list()
g1=list()
#
for i in range(len(objeto1)):
    if i == 0:
        for j in (objeto1[0]):
            x1.append(j)
    if i== 1:
        for j in (objeto1[1]):
            g1.append(j)
x2=len(x1)            
## primera cigra
for i in range(len(x1)):
    if i == len(x1)-1:
        x += int(x1[len(x1)-1])
    else:
        x += 10**(x2-1)*(int(x1[i]))
        x2 -=1


##segunda cirfra
g2=len(g1)
for i in range(len(g1)):
    
    if i == len(g1)-1:
        g += int(g1[len(g1)-1])
    else:
        g += (10 ** (g2-1)) * int(g1[i])
        g2 -= 1

#organizando terminos
polinomio=list()
ecuacion=list()
ecuacion2=int()
formula2=""
formula5=list()
for i in formula1:
    formula2 += str(i)
formula3=formula2.split("+")
formula2=""

for i in range(len(formula3)):
    formula3[i]= "+" + formula3[i]
    formula2+=formula3[i]

for i in range(len(formula3)):
    for j in formula3[i]:
        if j == "-":
            formula4=formula3[i].split("-")
            for k in range(len(formula4)):
                formula5.append("-"+formula4[k])
formula4=list()
for i in range(len(formula5)):
    for j in formula5[i]:
        if j == "+":
            formula4=formula5[i].split("+")     
            formula5.append("+" +formula4[1])
            del formula5[i]
                        
# eliminar x y ** 
#organizar ecuacion #creacion de matriz
u=list()
for i in range(len(formula5)):
    for j in formula5[i]:
        u.append(j)            
    ecuacion.append(u)
    u=[]


ecua=""
p=""
#eliminar x y ** 
for i in range(len(ecuacion)):
    for j in range(len(ecuacion[i])):
        if ecuacion[i][j] != "*":
            p =p + (ecuacion[i][j] )
    if 0<=i<len(ecuacion)-1:
        p=p+"y"
ecua=p
print(ecua)
ecua1=ecua.split("y") 
for i in range(len(ecua1)):
    for j in range(len(ecua1[i])):
        if ecua1[i][j] != "*":
            p =p + (ecua1[i][j] )
    if 0<=i<len(ecuacion)-1:
        p=p+"y"
print(p)
ecua2=list()

for i in range(len(ecua1)):
    for j in ecua1[i]:
        u.append(j)            
    ecua2.append(u)
    u=[]
print(ecua2)
