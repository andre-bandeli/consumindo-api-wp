
from .models import Usuarios
from django.views.generic import ListView
from rest_framework import routers, serializers, viewsets

# def list(request):
#     data = {}
#     data['db'] = Usuarios.objects.all()
#     return render(request, 'list.html', data)


class UserSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Usuarios
        fields = ['id', 'nome', 'email', 'departamento', 'ramal', 'data_nascimento', 'is_active']

class List(viewsets.ModelViewSet):
    
    queryset = Usuarios.objects.all()
    serializer_class = UserSerializer