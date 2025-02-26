<?php

namespace App\Models;

use App\Observers\ActionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(ActionObserver::class)]
class Action extends Model
{
    /** @use HasFactory<\Database\Factories\ActionFactory> */
    use HasFactory;

    protected $table = 'actions';

    protected $fillable = ['accion', 'slug', 'sort'];




}
