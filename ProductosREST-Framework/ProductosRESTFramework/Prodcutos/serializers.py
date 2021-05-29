from rest_framework import serializers
from .models import * 


class productoSerializer(serializers.ModelSerializer):
    class Meta:
        model = productos
        fields = '__all__'

class detallesSerializer(serializers.ModelSerializer):
    class Meta:
        model = detalles_productos
        fields = ['idProducto','cantidad']
