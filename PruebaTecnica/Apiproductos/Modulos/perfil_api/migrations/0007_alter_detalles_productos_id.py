# Generated by Django 3.2.2 on 2021-05-11 16:37

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('perfil_api', '0006_alter_productos_precio'),
    ]

    operations = [
        migrations.AlterField(
            model_name='detalles_productos',
            name='id',
            field=models.AutoField(primary_key=True, serialize=False),
        ),
    ]
