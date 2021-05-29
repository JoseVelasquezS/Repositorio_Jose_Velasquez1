from django.shortcuts import render
from rest_framework import viewsets
from .models import *
from .serializers import *
from django.http import Http404
from rest_framework.views import APIView
from rest_framework.response import Response


# Create your views here.


class productosViewSet(viewsets.ModelViewSet):
    serializer_class = productoSerializer

    queryset = productos.objects.all()
#class productosViewSet(APIView):

    def get(self,request,fromat=None):
        an_apiview = [
            'usando los metodods post, get,etc'
        ]

        return Response({'message' : 'hello', 'an_apiview' : an_apiview })
    
    def post(self, request):
        serializer = serializer_class(data=request.data)

        if serializer.is_valid():
            nombre = serializer.validated_data.get('nombre')
            precio = serializer.validated_data.get('precio')     
            descripcion = serializer.validated_data.get('descripcion') 

            return Response({'nombre':nombre, 'precio':precio, 'descripcion':descripcion})  
        else :
            return Response(
                serializer.errors,
                status=starus.HTTP_404_BAD_REQUEST
            )
    
    def put(self, request, pk, format=None):
        snippet = self.get_object(pk)
        serializer = SnippetSerializer(snippet, data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

    def patch(self, request):
        return Response({'method':'PATCH'})

    
    def delete(self, request, pk, format=None):
        snippet = self.get_object(pk)
        snippet.delete()
        return Response(status=status.HTTP_204_NO_CONTENT)


class detalle_ViewSet(viewsets.ModelViewSet):
    serializer_class = detallesSerializer

    queryset = detalles_productos.objects.all()

    def get(self,request):
        an_apiview = [
            'usando los metodods post, get,etc'
        ]

        return Response({'message' : 'hello', 'an_apiview' : an_apiview })
    
    def post(self, request):
        serializer = serializer_class(data=request.data)

        if serializer.is_valid():
            nombre = serializer.validated_data.get('nombre')
            precio = float(serializer.validated_data.get('precio'))       
            descripcion = serializer.validated_data.get('descripcion') 

            return Response({'nombre':nombre, 'precio':precio, 'descripcion':descripcion})  
        else :
            return Response(
                serializer.errors,
                status=starus.HTTP_404_BAD_REQUEST
            )
    
        
