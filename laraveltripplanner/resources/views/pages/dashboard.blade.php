<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard</title>
    <!-- Page Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <!-- Bootstrap -->
    @include('includes.bootstrap')

    <!-- Style Sheet For This Page -->
    <link href="./css/pages/dashboard.css" rel="stylesheet" type="text/css">

    <!-- Javascript Pages -->
    <script src="http://maps.google.com/maps/api/js?libraries=places&callback=initFunc"
      type="text/javascript"
      async defer></script>

    <script src="./js/pages/dashboard.js"
      type="text/javascript"
      async defer></script>



<!--     <script src="https://maps.googleapis.com/maps/api/js?callback=init"
      async defer></script> -->
  </head>
  <body>
    <!-- Navigation Bar -->
    @include('includes.header')
    <!-- Contains Everything Below Navbar -->
    <div class="row">
      <!-- Left Column Which Contains Google Map -->
      <div class="col-sm-9 title content">
        <div id="map"></div>
      </div>
      <!-- Right Column Sidebar -->
      <div class="col-sm-3">
          <!-- Start Accordion Panel -->
          <div class="panel-group" id="accordion">

            <!-- New Route Accordion -->
            <div class="panel panel-default">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                <div class="panel-heading panelheaders">
                  <h4 class="panel-title">
                    <span class="glyphicon glyphicon-list"></span>
                    Create Route
                  </h4>
                </div>
              </a>
              <div id="collapse1" class="panel-collapse collapse">

                <!-- Map Stuff -->
                <div class="panel-body" id="searchPanel">
                  <label for="map-input">Add Waypoint:</label>
                  <input id="map-input" class="controls" type="text" placeholder="Search Box">
                </div>
                <div id="warnings-panel"></div>
                <div class="panel-body" id="routes"></div>

                @if (Auth::guest())
                      <div class="panel-body">Login to save route</div>
                @else
                  <!-- Create Route Form-->
                  <form class="form-horizontal" role="form" method="POST" action="createRoute">
                    {!! csrf_field() !!}
                    <div class="row">
                      <div class="panel-body">
                        <!-- Route Name Input-->
                        <div class="form-group{{ $errors->has('rname') ? ' has-error' : '' }}">
                          <label class="control-label col-sm-4">Route Name:</label>
                          <div class="col-md-8">
                            <input type="text" class="form-control" name="rname" id="route-name">
                            @if ($errors->has('rname'))
                              <span class="help-block">
                                <strong>{{ $errors->first('rname') }}</strong>
                              </span>
                            @endif
                            <input type="hidden" id="waypoints" name="waypoints" value="">
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                  </form>
                  <!-- End Create Route Form-->
                @endif
              </div>
            </div>
            <!-- End New Route Accordion -->

            <!-- My Routes Accordion -->
            <div class="panel panel-default">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                <div class="panel-heading panelheaders">
                  <h4 class="panel-title">
                    <span class="glyphicon glyphicon-list"></span>
                    My Routes
                  </h4>
                </div>
              </a>
              <div id="collapse2" class="panel-collapse collapse in">
                <div class="panel-body sidebar-panel">
                  @if (Auth::guest())
                    <div class="panel-body">Login to view your routes</div>
                  @else
                    @foreach($user->ownedRoutes as $route)
                      <!-- Waypoint Prep Code -->
                      <?php $routeWaypoints = $route->waypoints; ?>
                      <?php $waypointsAddrs = array(); ?>
                      @foreach($routeWaypoints as $routeWaypoint)
                        <?php $waypointsAddrs[$routeWaypoint->index] = $routeWaypoint->addr; ?>
                      @endforeach
                      <?php $waypointsAddrsString = "['" . implode("','", $waypointsAddrs) . "']"; ?>
                      <div class="sidebar-row row" onclick="sidebarClick(this,<?php echo $waypointsAddrsString; ?>)">
                        <div class="col-sm-6">
                          <?php echo $route->rname ?>
                        </div>
                        <div class="col-sm-6">
                          <div class="row"></div> 
                          <div class="row"></div>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
            <!-- End My Routes Accordion -->

            <!-- Shared Routes Accordion -->
            <div class="panel panel-default">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                <div class="panel-heading panelheaders">
                  <h4 class="panel-title">
                    <span class="glyphicon glyphicon-list"></span>
                    Shared Routes
                  </h4>
                </div>
              </a>
              <div id="collapse3" class="panel-collapse collapse">
                <div class="row">
                  <div class="panel-body sidebar-panel">
                    @if (Auth::guest())
                      <div class="panel-body">Login to view shared routes</div>
                    @else
                      <!-- Routes You Shared -->
                      <div class="row"><h4>Friends' Routes</h4></div>
                      @foreach($friends as $friend)
                        <div class="panel-group">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapsefriend{{$friend->id}}">
                                  <div class="row" style="padding-right: 10; padding-left: 10; ">
                                    <?php echo $friend->name; ?>
                                  </div>
                                </a>
                              </h4>
                            </div>
                            <div id="collapsefriend{{$friend->id}}" class="panel-collapse collapse">
                              <ul class="list-group">
                                @foreach($friend->ownedRoutes as $route)
                                  <li class="list-group-item">
                                    <!-- Waypoint Prep Code -->
                                    <?php $routeWaypoints = $route->waypoints; ?>
                                    <?php $waypointsAddrs = array(); ?>
                                    @foreach($routeWaypoints as $routeWaypoint)
                                      <?php $waypointsAddrs[$routeWaypoint->index] = $routeWaypoint->addr; ?>
                                    @endforeach
                                    <?php $waypointsAddrsString = "['" . implode("','", $waypointsAddrs) . "']"; ?>

                                    <div class="sidebar-row row" onclick="sidebarClick(this,<?php echo $waypointsAddrsString; ?>)">
                                      <div class="col-sm-6">
                                        <?php echo $route->rname ?>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="row"></div>
                                        <div class="row"></div>
                                      </div>
                                    </div>
                                  </li>
                                @endforeach
                              </ul>
                            </div>
                          </div>
                        </div>
                      @endforeach


                      <!-- Your Groups' Routes -->
                      <div class="row"><h4>Your Groups' Routes</h4></div>
                      @foreach($ownedGroups as $ownedGroup)
                        <div class="panel-group">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapsegroup{{$ownedGroup->id}}">
                                  <div class="row" style="padding-right: 10; padding-left: 10; ">
                                    <?php echo $ownedGroup->gname; ?>
                                  </div>
                                </a>
                              </h4>
                            </div>
                            <div id="collapsegroup{{$ownedGroup->id}}" class="panel-collapse collapse">
                              <ul class="list-group">
                                @foreach($ownedGroup->owner->ownedRoutes as $route)
                                  <li class="list-group-item">
                                    <!-- Waypoint Prep Code -->
                                    <?php $routeWaypoints = $route->waypoints; ?>
                                    <?php $waypointsAddrs = array(); ?>
                                    @foreach($routeWaypoints as $routeWaypoint)
                                      <?php $waypointsAddrs[$routeWaypoint->index] = $routeWaypoint->addr; ?>
                                    @endforeach
                                    <?php $waypointsAddrsString = "['" . implode("','", $waypointsAddrs) . "']"; ?>

                                    <div class="sidebar-row row" onclick="sidebarClick(this,<?php echo $waypointsAddrsString; ?>)">
                                      <div class="col-sm-6">
                                        <?php echo $route->rname ?>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="row"></div>
                                        <div class="row"></div>
                                      </div>
                                    </div>
                                  </li>
                                @endforeach
                              </ul>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <!-- End Shared Routes Accordion -->

            <!-- Friends Accordion  -->
            <div class="panel panel-default">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                <div class="panel-heading panelheaders">
                  <h4 class="panel-title">
                    <span class="glyphicon glyphicon-list"></span>
                    Friends
                  </h4>
                </div>
              </a>
              <div id="collapse4" class="panel-collapse collapse">
                <!-- All Users  -->
                <div class="row">
                  @if (Auth::guest())
                    <div class="panel-body">Login to view friends</div>
                  @else
                    <div class="panel-body">
                      <div class="row"><h4>All Users</h4></div>
                      @foreach($users as $otheruser)
                        @if($otheruser->id != $user->id) <!-- Logged in user will not show up on list of all users -->
                          <div class="row">
                            <div class="col-sm-9"> &nbsp;&nbsp;&nbsp;<?php echo $otheruser->name; ?></div>
                            <div class="col-sm-3">
                              <!-- Add Friend Button Only Shows Up If Not Friends -->
                              @if(!in_array($otheruser->id, $friendIds))
                                <form class="form-horizontal" role="form" method="POST" action="addFriend">
                                  {!! csrf_field() !!}
                                  <input type="hidden" name="user_id" value="{{$otheruser->id}}">
                                  <button type="submit" class="btn btn-success btn-xs">Add</button>
                                </form>
                              @endif
                            </div>
                          </div>
                        @endif
                      @endforeach
                    </div>
                    <!-- Your Friends  -->
                    <div class="row">
                      <div class="panel-body">
                        <div class="row"><h4>Your Friends</h4></div>
                        @foreach($friends as $friend)
                          <div class="row">
                            <div class="col-sm-9"> &nbsp;&nbsp;&nbsp;<?php echo $friend->name; ?></div>
                            <div class="col-sm-3">
                              <form class="form-horizontal" role="form" method="POST" action="removeFriend">
                                {!! csrf_field() !!}
                                <input type="hidden" name="user_id" value="{{$friend->id}}">
                                <button type="submit" class="btn btn-danger btn-xs">Remove</button>
                              </form>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  @endif
                </div>
              </div>
            </div>
            <!-- End Friends Accordion  -->

            <!-- Groups Accordion -->
            <div class="panel panel-default">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                <div class="panel-heading panelheaders">
                  <h4 class="panel-title">
                    <span class="glyphicon glyphicon-list"></span>
                    Groups
                  </h4>
                </div>
              </a>
              <div id="collapse5" class="panel-collapse collapse">
                <!-- All Groups -->
                @if (Auth::check())
                  <div class="row">
                    <div class="panel-body">
                      <div class="row"><h4>All Groups</h4></div>
                      @foreach($groups as $group)
                        <div class="panel-group">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h5 class="panel-title">
                                <div class="row" style="padding-right: 10; padding-left: 10; ">
                                  <a data-toggle="collapse" href="#collapsegroupmembers{{$group->id}}">
                                    <div class="col-sm-10" style="padding: 0">
                                       &nbsp;&nbsp;&nbsp;<?php echo $group->gname; ?> &nbsp;<i> owned by </i>&nbsp;
                                       <?php echo ($group->owner->id == $user->id ? 'you!' : $group->owner->name); ?>
                                    </div>
                                  </a>
                                  <div class="col-sm-2">
                                    <!-- Join Group Button Only Shows Up If Not In Group -->
                                    @if(!in_array($group->id, $groupIds))
                                      <form class="form-horizontal" role="form" method="POST" action="joinGroup">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="group_id" value="{{$group->id}}">
                                        <button type="submit" class="btn btn-success btn-xs">Join</button>
                                      </form>
                                    <!-- Leave Group Button Only Shows Up If Not Group Owner -->
                                    @elseif($group->owner->id != $user->id)
                                      <form class="form-horizontal" role="form" method="POST" action="leaveGroup">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="group_id" value="{{$group->id}}">
                                        <button type="submit" class="btn btn-danger btn-xs">Leave</button>
                                      </form>
                                    @endif
                                  </div>
                                </div>
                              </h5>
                            </div>
                            <div id="collapsegroupmembers{{$group->id}}" class="panel-collapse collapse">
                              <ul class="list-group">
                                @foreach($group->members as $member)
                                  <li class="list-group-item">
                                    &nbsp;&nbsp;&nbsp;<?php echo $member->name ?>
                                  </li>
                                @endforeach
                              </ul>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <!-- Owned Groups -->
                  <div class="row">
                    <div class="panel-body">
                      <div class="row"><h4>Owned Groups</h4></div>
                      @foreach($ownedGroups as $ownedGroup)
                        <div class="panel-group">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapseownedgroupmembers{{$ownedGroup->id}}">
                                  <div class="row" style="padding-right: 10; padding-left: 10; ">
                                    <?php echo $ownedGroup->gname; ?>
                                  </div>
                                </a>
                              </h4>
                            </div>
                            <div id="collapseownedgroupmembers{{$ownedGroup->id}}" class="panel-collapse collapse">
                              <ul class="list-group">
                                @foreach($ownedGroup->members as $member)
                                  <li class="list-group-item">
                                    &nbsp;&nbsp;&nbsp;<?php echo $member->name ?>
                                  </li>
                                @endforeach
                              </ul>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <!-- Create Group -->
                  <form class="form-horizontal" role="form" method="POST" action="createGroup">
                    {!! csrf_field() !!}
                    <div class="row">
                      <div class="panel-body">
                        <h4>Create Group</h4>

                        <!-- Group Name Input-->
                        <div class="form-group{{ $errors->has('gname') ? ' has-error' : '' }}">
                          <label class="control-label col-sm-4">Group Name</label>
                          <div class="col-md-8">
                            <input type="text" class="form-control" name="gname">
                            @if ($errors->has('gname'))
                              <span class="help-block">
                                <strong>{{ $errors->first('gname') }}</strong>
                              </span>
                            @endif
                          </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                      </div>
                    </div>
                  </form>
                  <!-- End Create Group -->
                @else
                  <div class="panel-body">Login to view groups</div>
                @endif

              </div>
            </div>
            <!-- End Groups Accordion -->

          </div>
          <!-- End Accordion Panel -->
        </div>
    </div>
  </body>
</html>
