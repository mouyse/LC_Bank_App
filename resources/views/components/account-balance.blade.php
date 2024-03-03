<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
      {{ $badge_class = "" }}
      @if ($accountBalance < 0) {
        $badge_class="badge-danger";
      }else{
        $badge_class="badge-success";
      }
      @endif
    Account Balance: <span class="btn btn-primary">{{ $accountBalance }}</span>
</div>
