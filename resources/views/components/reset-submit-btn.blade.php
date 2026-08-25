<div>
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    <footer class="container-fluid position-fixed bg-white p-0" style="bottom: 0; left: 0; right: 0; z-index: 100;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="action-bar py-3 p-0 actions">
                        <button type="reset" id="reset_{{$id}}" class="btn py-2 px-5 btn btn-outline-secondary">Reset</button>	
                        <button type="submit" id="submit_{{$id}}" class="btn py-2 px-5  btn-primary">Save</button>
						
					
						
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>

<script>
    let resetBtn = document.getElementById("reset_{{ $id }}");
    resetBtn.addEventListener('click', () => {      
        switch (resetBtn.id) {
            case "reset_plateTapping":
                clearInterval(interval);
                minute = 0;
                second = 0;
                milisecond = 0;
                isRunning = false;
                updateDisplay();   
                startTimerBtn.classList.remove("hide");
                saveBtn.classList.add("hide");
                timerLabel.textContent = "Start Timer";
                document.getElementById('total_milisecond_id').value = "";
                break;
            case "reset_strength":
            case "reset_1019":
            case "reset_1020":  
                startBtn.classList.remove("hide");
                clearInterval(timerInterval);
                saveBtn.classList.add("hide");
                countInput.disabled = true;
                startBtn.innerHTML = `<i class="bi bi-stopwatch"></i><span>Start Timer</span>`;
                timeLeft = 30000;
                updateTimerDisplay(timeLeft);
                countInput.value = "";
                break;
            case "reset_flamingo":
                clearInterval(timer);
                timer = null;
                elapsed = 0;
                pauseCount = 0;
                pauseCountInput.value = 0;
                isDisqualify.value = 'No';
                startBtn.disabled = false;
                startBtn.innerText = "Start Timer";
                saveBtn.classList.add("hide");
                startBtn.classList.remove("paused");
                updateTimerDisplay(0);
                disqualifiedMsg.style.display = "none"; 
                saveBtn.classList.add("hide"); 
                break;

            case "reset_flexibility":
                document.getElementById("net_score").style.display = "none";
                break;
            case "reset_pushups":
             case "reset_1021":
            case "reset_1023":
            case "reset_1022":
            case "reset_1042":
                clearInterval(timerInterval);
                elapsed = 0;
                running = false;
                startPauseBtn.textContent = "Start Timer";
                display.innerHTML = "00:00:00";
                pushUpInput.value = "";
                break;
            case "reset_1043":
            case "reset_1017":
                document.getElementById('live_status_badge').textContent = `Level 1, Shuttle 0`;
                break;
            case "reset_1041":
                document.getElementById("btn-fail").classList.remove("btn-danger");
                document.getElementById("btn-fail").classList.add("btn-outline-danger");
                document.getElementById("btn-pass").classList.remove("btn-success");
                document.getElementById("btn-pass").classList.add("btn-outline-success");   
                document.getElementById('reverse_curlup').value = '';         
                break;
            case "reset_1025":
                document.getElementById('best_score').style.display = "none";
            
            default:
                break;
        }
    });
</script>