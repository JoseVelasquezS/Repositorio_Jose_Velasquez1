palabra=input()
mayusculas=list()
minusculas=list()
numeros=list()
final=""
for i in range(len(palabra)):
    if (palabra[i]).islower():
        #print(palabra[i])
        minusculas.append(palabra[i])
    elif(palabra[i]).isupper():
        #print(palabra[i])
        mayusculas.append(palabra[i])
    else:
        numeros.append(palabra[i])
minusculas=sorted(minusculas)
mayusculas=sorted(mayusculas)
for i in minusculas:
    final += i
for i in mayusculas:
    final += i
pares=list()
impares=list()
for i in range(len(numeros)):
    if ((int(numeros[i])+1)%2) == 0:
        impares.append(numeros[i])
    else:
        pares.append(numeros[i])
for i in impares:
    final += i
for i in pares:
    final += i

print(final)
