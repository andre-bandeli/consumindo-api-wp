from django.urls import path
from .views import List

app_name = "api"

urlpatterns = [
    path("list/", List.as_view({'get': 'list'}), name="list"),
    path("list/?departamento=comunicacao", List.as_view({'get' : 'list'}), name='list/departamento')
]