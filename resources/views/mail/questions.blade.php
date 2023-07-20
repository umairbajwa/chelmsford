<div class="talbe-content webview">
    <table>
        <tr style="display: flex">
            <td class="table-column">
                @foreach ($questionsData as $index => $data)
                @php
                if($index % 2 != 0){
                continue;
                }
                @endphp
                <table >
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td style="font-weight: 700;font-size: 12px;">{{ $data['question'] }}</td>
                                </tr>
                                <tr>
                                    <td style="display: flex;font-size: 12px;">
                                        @if (is_array($data['answer']))
                                        <ul style="display: inline-block;padding-left: 10px;margin-top: 0;">
                                            @foreach ($data['answer'] as $answer)
                                            <li >
                                                {{ $answer['question'] }} => {{ $answer['qty'] }}
                                            </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        {{ $data['answer'] }}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                @endforeach
            </td>
            <td class="table-column">
                @foreach ($questionsData as $index => $data)
                @php
                if($index % 2 == 0){
                continue;
                }
                @endphp
                <table >
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td style="font-weight: 700;font-size: 12px;">{{ $data['question'] }}</td>
                                </tr>
                                <tr>
                                    <td style="display: flex;font-size: 12px;">
                                        @if (is_array($data['answer']))
                                        <ul style="display: inline-block;padding-left: 10px;margin-top: 0;">
                                            @foreach ($data['answer'] as $answer)
                                            <li>
                                                {{ $answer['question'] }} => {{ $answer['qty'] }}
                                            </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        {{ $data['answer'] }}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                @endforeach
            </td>
        </tr>

    </table>
</div>

<div class="talbe-content mobileview">
    <table>
        @foreach ($questionsData as $index => $data)
        <tr style="display: flex">
            <td>
                <table>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td style="font-weight: 700;"><span style="margin-right: 10px">Q.</span>{{ $data['question'] }}</td>
                                </tr>
                                <tr>
                                    <td style="display: flex">
                                        <span style="margin-right: 10px; font-weight: 700;">A.</span>
                                        @if (is_array($data['answer']))
                                        <ul style="display: inline-block;padding-left: 10px;margin-top: 0;margin-bottom: 0px;">
                                            @foreach ($data['answer'] as $answer)
                                            <li>
                                                {{ $answer['question'] }} => {{ $answer['qty'] }}
                                            </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        {{ $data['answer'] }}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        @endforeach
    </table>
</div>
