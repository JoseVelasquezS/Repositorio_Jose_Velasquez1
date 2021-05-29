from django.db import models

# Create your models here.
#ORM

class carrera(models.Model):
    codigo = models.CharField(max_length=3,primary_key=True)
    nombre = models.CharField(max_length=50)
    duracion = models.PositiveSmallIntegerField(default=5)

class Estudiante (models.Model):
    dni = models.CharField(max_length=8, primary_key=True)
    apellidoPaterno = models.CharField(max_length=35)
    apellidoMaterno = models.CharField(max_length=35)
    Nombres = models.CharField(max_length=35)
    FechaNacimiento = models.CharField()
    sexo = [
        ('F', 'femenino'),
        ('M', 'Masculuno')
    ]
    sexo = models.CharField(max_length=1, choices=sexo, default='F')
    carrera = models.ForeignKey(carrera, null=False, blank=False, on_delete=models.CASCADE)
    vigencia = models.BooleanField(default = True)

    def nombreCompleto(self):
        txt = "{0} {1}, {2}"
        return txt.format(self.apellidoPaterno,self.apellidoMaterno,self.Nombres)

class Curso (models.Model):
    codigo = models.CharField(max_length=6, primary_key=True)
    nombre = models.CharField(max_length=30)
    creditos = models.PositiveSmallIntegerField()
    docente = models.CharField(max_length=100)
    
class Matricula (models.Model):
    id = models.AutoField(primary_key=True)
    estudiante = models.ForeignKey(Estudiante, null=False, blank=False, on_delete=models.CASCADE)
    curso = models.ForeignKey(Curso, null=False, blank=False, on_delete=models.CASCADE)
    fechaMatricula = models.DateTimeField(auto_now_add=True)
    
