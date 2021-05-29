from django.db import models
from djmoney.models.fields import MoneyField

# Create your models here.

class productos(models.Model):
    id = models.AutoField(primary_key=True)
    nombre = models.CharField(max_length=20)
    

    precio = MoneyField(
        decimal_places=2,
        default=0,
        default_currency='COP',
        max_digits=11,
    )
    #precio = models.FloatField(max_length=20)
    descripcion = models.TextField()
    def __str__(self):
        txt = "Cod-producto ({0}) : {1} "
        return txt.format(self.id,self.precio)
    


class detalles_productos(models.Model):
    idProducto = models.ForeignKey(productos, null=False, blank=False, on_delete=models.CASCADE)
    cantidad = models.FloatField(max_length=20)
    valorTotal = models.FloatField(max_length=20)
    valorIva = models.FloatField(max_length=20)
