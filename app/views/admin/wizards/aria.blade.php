@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

<div class="tabbable columns">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a id="n.1" href="#declarations1" data-toggle="tab"> Declarations </a></li>
        <li class=""><a id="n.2" href="#hradetails1" data-toggle="tab">HRA Details</a></li>
        <li class=""> <a id="n.3" href="#preEmpSalary1" data-toggle="tab">Previous Employment Salary</a></li>
        <li><a id="n.4" href="#otherIncome1" data-toggle="tab">Other Income</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="declarations1">
            <p>The first content</p>
           <input type="button" onclick="document.getElementById('n.2').click()" value="Next" />
        </div>
        <div class="tab-pane fade" id="hradetails1">
            <p>The 2nd content</p>
            <input type="button" onclick="document.getElementById('n.3').click()" value="Next" />
            <input type="button" onclick="document.getElementById('n.1').click()" value="Previous" />
        </div>
        <div class="tab-pane fade" id="preEmpSalary1">
            <p>The 3rd content</p>
            <input type="button" onclick="document.getElementById('n.4').click()" value="Next" />
            <input type="button" onclick="document.getElementById('n.2').click()" value="Previous" />
        </div>
        <div class="tab-pane fade" id="otherIncome1">
            <p>The 4th content</p>
            <input type="submit" value="submit" />
        </div>
    </div>
</div>

@stop