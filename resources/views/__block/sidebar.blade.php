
<div class="sidebar sidebar-main sidebar-grey ">
    <div class="sidebar-content">
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion" style="padding-top: 0;">

                    <li>
                        <a href="#" class="has-ul"><i class="icon-file-text"></i> <span>{{ __('sidebar.content') }}</span></a>
                        <ul class="hidden-ul">
                            <li><a href="{{ route('admin_faq') }}"> <span>{{ __('sidebar.admin_faq') }}</span></a></li>
                            <li><a href="{{ route('admin_term') }}"> <span>{{ __('sidebar.admin_term') }}</span></a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="has-ul"><i class="icon-wrench3"></i> <span>{{ __('sidebar.libs') }}</span></a>
                        <ul class="hidden-ul">
                            <li><a href="{{ route('admin_lib_spec') }}"> <span>{{ __('sidebar.admin_lib_spec') }}</span></a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('sample_video') }}"><i class="icon-video-camera"></i> <span>{{ __('sidebar.sample_video') }}</span></a></li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>