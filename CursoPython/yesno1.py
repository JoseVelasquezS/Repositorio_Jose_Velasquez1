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
for j in range(n):
    count=0
    if  len(clas[j])== 2:
        print("Yes")
    
    else: 
        if  len(clas[j])== 3:
            if clas[i][int((len(clas[i])/2))] <= clas[i][int((len(clas[i])/2))+1] or clas[i][int((len(clas[i])/2))] <= clas[i][int((len(clas[i])/2))-1]:
                #valor1="Yes"
                count = len(clas[j])-1
        else:
            i=0
            l = len(clas[j])
            while i < l - 1 and clas[j][i] >= clas[j][i+1]:
                count +=1
                i += 1
            while i < l - 1 and clas[j][i]<= clas[j][i+1]:
                count += 1
                i += 1
        #print(count)
        if count == len(clas[j])-1:
            print("Yes")
        else:
            print("No")