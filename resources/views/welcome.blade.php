<form action="{{ url('coin') }}" method="post" accept-charset="utf-8">
            @csrf
                <div class="form-group">
                <label class="control-label col-sm-2" for="usd">Amount (USD)</label>
                <div class="col-sm-10">
                <input type="text" id="amount" name="amount">
                </div>
                </div>
                <button value="submit" id="submit" name="submit" type="submit" >Submit Amount</button>
            </div>
</form>
