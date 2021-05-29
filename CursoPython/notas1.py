if __name__ == '__main__':
    stu=[]
    for i in range(int(input())):
        name = input()
        score = float(input())
        stu.append([])
        stu[i]=[score, name]
    stu.sort()
    total=list()
    count=0
    stu1=list()
    for i in range(len(stu)):
        if i != 0:
            if stu[0][0] < stu[i][0]:
                if stu[i][0] == stu[i+1][0]:
                    stu1.append(stu[i][1])
                    stu1.append(stu[i+1][1])
                    stu1.sort()
                    for j in stu1:
                        print(j)

                    break
                else:
                    print(stu[i][1])
                    break
            