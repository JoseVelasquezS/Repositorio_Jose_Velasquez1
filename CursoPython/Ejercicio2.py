nombre=(input("ingrese el nombre: "))
direccion=str(input("ingrese el Direccion: "))
tfno=int(input("ingrese el Telefono: "))
if type(nombre) == type("") :
    print("correcto")
else:
    print("usted ingreso valores incorrectos de nombre")
lista=(nombre,direccion,tfno)
print("lo datos ingresados son: ", lista)

# inclompelto. hallar la manera para determinar si es una string o un int 
# es un problema de la funcion input- conclusion 