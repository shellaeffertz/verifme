@extends('layouts.app')

@section('style')
<style>

</style>
@endsection

@section('title')
    Form Inputs
@endsection


@section('content')
<div>
    <label for="title">Title</label>
    <input type="text" placeholder="texty stuff..." id="title" name="title"/>
</div>

<div>
    <label for="description">Description</label>
    <textarea rows=5 type="text" placeholder="texty stuff..." id="description" name="description"></textarea>
</div>

<div>
    <label for="selector">Options</label>
    <select name="selector" id="selector">
        <option value="dog">Dog</option>
        <option value="cat">Cat</option>
        <option value="hamster">Hamster</option>
        <option value="parrot">Parrot</option>
        <option value="spider">Spider</option>
        <option value="goldfish">Goldfish</option>
    </select>
</div>

<div>
    <input type="submit" value="submit"/>
</div>

@endsection


