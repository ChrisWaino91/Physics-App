<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">PP</a>
            <a href="#" class="simple-text logo-normal">Prodigy Physics</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            @if (Auth::user()->access_level == 1)
                <li>
                    <a data-toggle="collapse" href="#organisations" aria-expanded="true">
                        <i class="tim-icons icon-bank"></i>
                        <span class="nav-link-text">Organisations</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="organisations">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'organisations') class="active " @endif>
                                <a href="{{ route('organisations') }}">
                                    <p>View All Organisations</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'organisations') class="active " @endif>
                                <a href="{{ route('create_organisation') }}">
                                    <p>Create Organisation</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a data-toggle="collapse" href="#tasks" aria-expanded="true">
                        <i class="tim-icons icon-laptop"></i>
                        <span class="nav-link-text">Tasks</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="tasks">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'tasks') class="active " @endif>
                                <a href="{{ route('tasks') }}">
                                    <p>View All Tasks</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'tasks/create') class="active " @endif>
                                <a href="/tasks">
                                    <p>Create Task</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::user()->access_level == 2)
                <li>
                    <a data-toggle="collapse" href="#teachers" aria-expanded="true">
                        <i class="tim-icons icon-bank"></i>
                        <span class="nav-link-text">Teachers</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="teachers">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'teachers') class="active " @endif>
                                <a href="{{ route('teachers') }}">
                                    <p>View All Teachers</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'teachers') class="active " @endif>
                                <a href="{{ route('create_teacher') }}">
                                    <p>Create Teacher</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::user()->access_level == 3)
                <li>
                    <a data-toggle="collapse" href="#classgroups" aria-expanded="true">
                        <i class="tim-icons icon-bank"></i>
                        <span class="nav-link-text">Classes</span>
                        <b class="caret mt-1"></b>
                    </a>

                    <div class="collapse show" id="classgroups">
                        <ul class="nav pl-4">
                            <li @if ($pageSlug == 'classgroups') class="active " @endif>
                                <a href="{{ route('classgroups') }}">
                                    <p>View All Classes</p>
                                </a>
                            </li>
                            <li @if ($pageSlug == 'create_classgroup') class="active " @endif>
                                <a href="{{ route('create_classgroup') }}">
                                    <p>Create Class</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            <li @if ($pageSlug == 'profile') class="active " @endif>
                <a href="/profile">
                    <i class="tim-icons icon-single-02"></i>
                    <p>My Account</p>
                </a>
            </li>

        </ul>
    </div>
</div>
