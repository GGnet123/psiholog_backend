
<div class="sidebar sidebar-main sidebar-grey ">
    <div class="sidebar-content">
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion" style="padding-top: 0;">

                    <li><a href="{{ route('admin_stat') }}"><i class="icon-home"></i> <span>{{ __('sidebar.admin_index') }}</span></a></li>
                    <li><a href="{{ route('admin_record') }}"><i class="icon-file-text"></i> <span>{{ __('sidebar.admin_record') }}</span></a></li>
                    <li><a href="{{ route('admin_support') }}"><i class="icon-envelop3"></i> <span>{{ __('sidebar.admin_support') }}</span></a></li>
                    <li><a href="{{ route('admin_claim') }}"><i class="icon-pencil7"></i> <span>{{ __('sidebar.admin_claim') }}</span></a></li>
                    <li><a href="{{ route('admin_subscription') }}"><i class="icon-newspaper"></i> <span>{{ __('sidebar.admin_subscription') }}</span></a></li>
                    <li><a href="{{ route('admin_transaction') }}"><i class="icon-coin-dollar"></i> <span>{{ __('sidebar.admin_transaction') }}</span></a></li>
                    <li><a href="{{ route('admin_doctor') }}"><i class="icon-user-tie"></i> <span>{{ __('sidebar.admin_doctor') }}</span></a></li>
                    <li><a href="{{ route('admin_main_user') }}"><i class="icon-users"></i> <span>{{ __('sidebar.admin_main_user') }}</span></a></li>

                    <li>
                        <a href="#" class="has-ul"><i class="icon-video-camera"></i> <span>{{ __('sidebar.main_page') }}</span></a>
                        <ul class="hidden-ul">
                            <li><a href="{{ route('admin_gal_affirmation') }}"> <span>{{ __('sidebar.admin_gal_affirmation') }}</span></a></li>
                            <li><a href="{{ route('admin_gal_mantra') }}"> <span>{{ __('sidebar.admin_gal_mantra') }}</span></a></li>
                            <li><a href="{{ route('admin_gal_med_audio') }}"> <span>{{ __('sidebar.admin_gal_med_audio') }}</span></a></li>
                            <li><a href="{{ route('meditation_cat') }}"> <span>{{ __('sidebar.meditation_cat') }}</span></a></li>
                            <li><a href="{{ route('admin_gal_meditation') }}"> <span>{{ __('sidebar.admin_gal_meditation') }}</span></a></li>
                            <li><a href="{{ route('admin_gal_nature') }}"> <span>{{ __('sidebar.admin_gal_nature') }}</span></a></li>
                            <li><a href="{{ route('admin_gal_sleep') }}"> <span>{{ __('sidebar.admin_gal_sleep') }}</span></a></li>
                            <li><a href="{{ route('admin_gal_talk_to_me') }}"> <span>{{ __('sidebar.admin_gal_talk_to_me') }}</span></a></li>
                            <li><a href="{{ route('admin_gal_vdoh') }}"> <span>{{ __('sidebar.admin_gal_vdoh') }}</span></a></li>
                            <li><a href="{{ route('yoga_cat') }}"> <span>{{ __('sidebar.yoga_cat') }}</span></a></li>
                            <li><a href="{{ route('admin_gal_yoga') }}"> <span>{{ __('sidebar.admin_gal_yoga') }}</span></a></li>

                            <li><a href="{{ route('audio_book_cat') }}"> <span>{{ __('sidebar.audio_book_cat') }}</span></a></li>
                            <li><a href="{{ route('night_story_cat') }}"> <span>{{ __('sidebar.night_story_cat') }}</span></a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="has-ul"><i class="icon-book2"></i> <span>{{ __('sidebar.content') }}</span></a>
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
