<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{
    use HasFactory;
    protected $connection = 'pgsql';
    protected $fillable = [
        'Carpetilla',
        'Audiencia',
        'Fecha de Solicitud',
        'Fecha de Programación',
        'Año',
        'Mes',
        'Hora de Programación',
        'Días de Atraso en el Registro de la Audiencia',
        'Título del Delito 1',
        'Título del Delito 2',
        'Título del Delito 3',
        'Título del Delito 4',
        'Título del Delito 5',
        'Título del Delito 6',
        'Título del Delito 7',
        'Delito Genérico Depurado',
        'Delito Genérico Agrupado',
        'Capítulo del Delito 1',
        'Capítulo del Delito 2',
        'Capítulo del Delito 3',
        'Capítulo del Delito 4',
        'Capítulo del Delito 5',
        'Capítulo del Delito 6',
        'Capítulo del Delito 7',
        'Artículo del Delito 1',
        'Artículo del Delito 2',
        'Artículo del Delito 3',
        'Artículo del Delito 4',
        'Artículo del Delito 5',
        'Artículo del Delito 6',
        'Artículo del Delito 7',
        'Delito Específico Depurado',
        'Delitos Agrupados',
        'Total de Peticiones',
        'Sujetos',
        'Peticiones',
        'Petición Depurada',
        'Seleccione la Subpetición de Actos de Investigación',
        'Ampliación de la Petición',
        'Petición Hecha por: (Manual, Plataforma, Audiencia)',
        '¿Se Realizó?: Sí/No',
        'Fase de la Audiencia',
        '¿Si no se Realizó?: Causa de no Realización',
        'Decisión Resumida',
        'Decisión Depurada',
        'Detalle de la Decisión o de la Pena',
        'Número de la Sentencia',
        'Medidas de Suspensión, Medida Cautelar y Protección',
        'Hora de Inicio',
        'Hora Final',
        'Tiempo Total Utilizado',
        'Defensa Depurada',
        'Sexo del Implicado',
        'Edad del Implicado',
        'Fecha de Nacimiento',
        'Estado Civil del Implicado',
        'Nacionalidad',
        'Etnia del Implicado',
        'Discapacidad del Implicado',
        'Ayuda del Implicado',
        'Tipo de Ayuda del Implicado',
        '¿Trabaja el Implicado?',
        '¿Ocupación del Implicado?',
        'Nivel Académico del Implicado',
        'Condición Procesal del Implicado Antes de la Audiencia',
        'Condición Procesal del Implicado Después de la Audiencia',
        'Fecha de Aprehensión',
        'Relación del Implicado con la Víctima',
    ];
    public $timestamps = false;
    protected $table = 'decisions';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    public function getDecision()
    {
        return $this->hasMany(Decision::class);
    }

    public function getDecisionById($id)
    {
        return $this->where('id', $id)->first();
    }

}
