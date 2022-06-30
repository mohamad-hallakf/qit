@extends('layouts.app', ['activePage' => 'test'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="text-center text-muted border border-bottom h2 p-2">
                <span class="mx-2">Test Name : {{ $test->name }} - </span>

                <span>Number of Question : {{ count($test->questions) }} </span>

            </div>

            <form id="addForm"   >
                <div class="main-carousel  ">

                    @foreach ($test->questions as $question)
                        <div class="carousel-cell">
                            <h2> {{ $loop->index + 1 }}<span>) </span>{{ $question->content }}</h2>
                            @php
                                $answers = [$question->right, $question->wrong1, $question->wrong2, $question->wrong3];
                                shuffle($answers);
                            @endphp
                            @for ($i = 0; $i < 4; $i++)
                                <div class="form-check mx-5">
                                    <input class="form-check-input" type="radio" name="qustion-{{ $question->id }}"
                                        @if ($i == 0) checked @endif id="flexRadio{{ $question->id }}"
                                        value="{{ $answers[$i] }}">
                                    <label class="form-check-label h5 text-muted" for="flexRadio{{ $question->id }}">
                                        {{ $answers[$i] }}
                                    </label>
                                </div>
                            @endfor
                        </div>
                    @endforeach
                    <input type="hidden" name="testID" value="{{ $test->id }}">
                </div>
            </form>

            <div class="row ">
                <div class=" col-9   mt-3">
                    <button class="button--previous btn btn-outline-primary">previous</button>
                    <button class="button--next btn btn-outline-primary">next</button>
                </div>
                <div class=" col-3   mt-3">
                    <button id='send' class="  btn btn-block btn-outline-success">send</button>

                </div>
            </div>


        </div>
    </div>

    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog text-center" role="document">
            <div class="modal-content">
                <div class="modal-header mx-auto">
                    <h5 class="modal-title " id="exampleModalLabel">The Result</h5>
                </div>
                <div class="modal-body">
                    <img id="resultImg" src="" alt="" width="100px">
                    <h3 id="result" class="mt-2 h3">fail</h3>
                    <h5 >Wrong Answers : <span id='wrongAns'> </span></h5>

                </div>
                <div class="modal-footer  justify-content-center">
                    <button type="button" id="ok" class="btn btn-secondary">{{ __('ok') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    .carousel-cell {
        width: 100%;


    }

    .main-carousel {

        align-content: center;
        justify-content: center;
    }
</style>
@push('js')
    <script type="text/javascript">
        var answersArray = []

       jQuery(document).ready(function() {
            $('#resultModal').modal({
                backdrop: 'static',
                keyboard: false
            })

            var $carousel = $('.main-carousel').flickity({
                prevNextButtons: false,
                contain: true,
                pageDots: false,
                wrapAround: true,

            });


            // Flickity instance
            var flkty = $carousel.data('flickity');
            // elements
            var $cellButtonGroup = $('.button-group--cells');
            var $cellButtons = $cellButtonGroup.find('.button');

            // update selected cellButtons
            $carousel.on('select.flickity', function() {
                $cellButtons.filter('.is-selected')
                    .removeClass('is-selected');
                $cellButtons.eq(flkty.selectedIndex)
                    .addClass('is-selected');
            });

            // select cell on button click
            $cellButtonGroup.on('click', '.button', function() {
                var index = $(this).index();
                $carousel.flickity('select', index);
            });
            // previous
            $('.button--previous').on('click', function() {
                $carousel.flickity('previous');
            });
            // next
            $('.button--next').on('click', function() {
                $carousel.flickity('next');
            });

            $('#ok').on('click', function() {
                location.href = "{{ route('home') }}";
            });


            $(document).on('click', '#send', function() {

                var data = $('#addForm').serialize();

                $.ajax({
                    url: "{{ route('test.applyTest') }}",
                    type: 'post',
                    dataType: 'json',
                    data: data,
                    success: function(data) {
                        if (data.response == true) {
                            $('#resultModal').modal('show')
                            var url = '{{ asset('material') }}/img/' + data.data.result + '.png'
                            $('#resultImg').attr('src', url)
                            $('#result').text( data.data.result)
                            $('#wrongAns').text( data.data.wrongAns)

                        }
                    }
                });


            })

        });
    </script>
@endpush
