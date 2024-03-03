<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
    Account Balance: <span class="btn @if ($account_balance<0) btn-danger @else btn-success @endif">{{ $account_balance }}</span>
</div>
