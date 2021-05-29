from django.contrib import admin
from aplicaciones.academia.models import *
# Register your models here.


admin.site.register(carrera)
admin.site.register(Estudiante)
admin.site.register(Matricula)
admin.site.register(Curso)