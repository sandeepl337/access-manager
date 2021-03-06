@extends('admin.header_footer')
@section('admin_container')
<?php 
$all_acct_class = Input::get('alphabet', NULL) == NULL ? 'active' : NULL;
?>
	<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2>
                        <i class="fa fa-users"></i>
                        Subscribers
                        <a href="{{route('subscriber.add.form')}}" class="btn btn-primary pull-right"><i class="fa fa-user"></i> New Subscriber</a>
                    </h2>
                    
                    
                </div>
            </div>
            <!-- <div class="container"> -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <ul class="nav nav-pills">
                        <li class="{{$all_acct_class}}"><a href="{{route('subscriber.index')}}">All Accounts</a></li>

                        @foreach(range('a','z') as $a)
                        <?php 
                            $class = Input::get('alphabet', NULL) == $a ? 'active' : NULL ;
                        ?>
                            <li class ="{{$class}}">
                                <a href="{{route('subscriber.index') . '?' . http_build_query(array_merge(Input::except('alphabet'),['alphabet'=>$a]))}}">{{$a}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <table class="table-responsive">
                    <table class="table table-striped table-responsive table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Contact Number</th>
                                <th>Created On</th>
                                <th>Account Type</th>
                                <th>Account Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = $accounts->getFrom(); ?>
                            @if( count($accounts) )
                          @foreach ($accounts as $a)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{link_to_route('subscriber.profile',$a->uname,$a->id)}}</td>
                                <td>{{$a->fname}} {{$a->lname}}</td>
                                <td>{{$a->contact}}</td>
                                <td>{{date("d-M-Y", strtotime($a->created_at))}}</td>
                                <td>
                                    @if($a->plan_type == FREE_PLAN)
                                    FRiNTERNET
                                    @elseif($a->plan_type == PREPAID_PLAN)
                                    Prepaid
                                    @elseif($a->plan_type == ADVANCEPAID_PLAN)
                                    Advance Paid
                                    @endif
                                </td>
                                <td>{{($a->status) ? 'Active' : 'Deactive'}}</td>
                                <td>
                                    {{Form::actions(
                                        route('subscriber.edit',$a->id),
                                        route('subscriber.delete',$a->id)
                                        )}}
                                    
                                </td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                        @else
                        <tr>
                            <td colspan='8'>No Records Found.</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg12 col-md-12 col-sm-12">
                  {{$accounts->links()}}
                </div>
            </div>
        <!-- </div> -->


@stop