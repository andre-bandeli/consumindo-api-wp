from django.db import models
from django.urls import reverse



class Usuarios(models.Model):
    id  = models.AutoField(primary_key=True)
    nome = models.CharField(max_length=500)
    email = models.EmailField()
    departamento = models.CharField(max_length=500)
    ramal = models.IntegerField(max_length=100)
    data_nascimento = models.DateField(auto_now=False)
    is_active = models.BooleanField(default=True)

    class Meta:
        ordering = ("nome",)

    class Meta:
        verbose_name_plural = "Usuarios"

    def __str__(self):
        return self.nome

    def get_absolute_url(self):
        return reverse("usuario:nome", kwargs={"nome": self.nome})


