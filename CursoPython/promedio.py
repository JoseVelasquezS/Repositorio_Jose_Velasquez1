if __name__ == '__main__':
    n = int(input())
    student_marks = {}
    for _ in range(n):
        name, *line = input().split()
        scores = list(map(float, line))
        student_marks[name] = scores
    query_name = input()
    count=float()
    pr=float()
    for i in student_marks.keys():
        if i == query_name:
            for j in student_marks[i]:
                count = count + float(j)
        pr= count / len(student_marks[i])
    
    print("{0:.2f}".format(pr))