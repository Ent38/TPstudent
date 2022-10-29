<div>
    <div class="modal fade" id="enrolledModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
        aria-hidden="true" data-backdrop="static" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">@lang('Enroll Now')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>

</div>
@livewire('login')
<style>
    .enrolment li {
        padding: 0.5em;
        background-color: rgb(255, 255, 255);
    }
</style>

@push('script')
    <script>
        $('.entrolledBtn').click(function(e) {
            @this.enrollNow(e.target.value)
            let elementName = $(this).attr('name');
            @this.set(elementName, e.target.value);
        });

        window.addEventListener('loginModal', event => {
            event.stopPropagation();
            $('#loginModal').modal('show');
        });

        window.addEventListener('closeModal', event => {
            event.stopPropagation();
            $('#enrolledModal').modal('hide');
            $('#loginModel').modal('hide');
        });

        document.addEventListener('livewire:load', function(event) {
            window.livewire.hook('afterDomUpdate', () => {
                // @this.enrollNow()
            });
        });
    </script>
@endpush
