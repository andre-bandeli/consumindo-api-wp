from django.contrib import admin
from .models import Usuarios


@admin.register(Usuarios)
class UsuariosAdmin(admin.ModelAdmin):
    list_display = ['id', 'nome', 'email', 'departamento', 'ramal', 'data_nascimento', 'is_active']
    list_filter = ['departamento', 'is_active']
    search_fields = ["nome", "email", "departamento"]


