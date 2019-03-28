<div class="col-lg-2">
<div class="box">
    <div class="box-body">
@php  
foreach($users as $entity)
{
    foreach($entity as $details)
    {
        echo "<a href=''>".$details->name."</a><br>";
    }
}
@endphp   
</div>
    </div>
</div>