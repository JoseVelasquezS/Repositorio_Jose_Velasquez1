# Enter your code here. Read input from STDIN. Print output to STDOUT 
n = int(input())
clas=list()
for i in range(n):
    clas.append([])
    y= int(input())
    u = (input()).split(" ")
    
    for j in range( len(u)):
        u[j]= int(u[j])
    clas[i]=u
valor= list()
valor1=""
count=0
for i in range(n):
    count = 0
    #print(len(clas[i])-int(round((len(clas[i])/2))))
    if len(clas[i])%2 == 0:
        for j in range(len(clas[i])- int((len(clas[i])/2))):
            if len(clas[i])==2:
                valor1="Yes     "
                break
            elif clas[i][j] >=  clas[i][len(clas[i])- (j+1)]:
                valor1="Yes"
            else:
                #print("entro")
                count += 1
                valor1="No"
                
    else:
        for j in range(len(clas[i])- int(round((len(clas[i])/2)))):
            if len(clas[i])==2:
                valor1="Yes"
            elif clas[i][j] >=  clas[i][len(clas[i])- (j+1)]:
                valor1="Yes"
            
            else:
                count += 1
                valor1="No"
        if clas[i][int((len(clas[i])/2))] <= clas[i][int((len(clas[i])/2))+1] or clas[i][int((len(clas[i])/2))] <= clas[i][int((len(clas[i])/2))-1]:
            valor1="Yes"
            count+=1
    print(count)
    if count%2 == 0 :
        valor1= "Yes"
    else: 
        valor1="No"  
    print(valor1)



            

            