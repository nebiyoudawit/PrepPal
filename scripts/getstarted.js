document.addEventListener("DOMContentLoaded", () => {
    const questions = document.querySelectorAll(".options, .options2, .options3");
    const progressBar = document.querySelector(".progress");
    const stepIndicator = document.querySelector(".step");
    const questionHeadings = document.querySelectorAll("h2");
  
    // Variables to store user answers
    let cookingSkill = "";
    let foodPreference = "";
    let cookingTime = "";
  
    let currentStep = 0;
  
    // Function to update progress bar and step
    const updateProgress = () => {
      const progressPercent = ((currentStep + 1) / questions.length) * 100;
      progressBar.style.width = `${progressPercent}%`;
      stepIndicator.textContent = `Step ${currentStep + 1} of ${questions.length}`;
    };
  
    // Function to show the current question and heading
    const showCurrentStep = () => {
      questions.forEach((question, index) => {
        question.style.display = index === currentStep ? "flex" : "none";
      });
  
      questionHeadings.forEach((heading, index) => {
        heading.style.display = index === currentStep ? "block" : "none";
      });
    };
  
    // Attach event listeners to options and store answers
    questions.forEach((question, index) => {
      const options = question.querySelectorAll(".option, .option2, .option3");
  
      options.forEach((option) => {
        option.addEventListener("click", () => {
          // Store the answer
          const answer = option.querySelector("p").textContent;
  
          if (index === 0) cookingSkill = answer;
          else if (index === 1) foodPreference = answer;
          else if (index === 2) cookingTime = answer;
  
          // Move to the next step
          if (index < questions.length - 1) {
            currentStep++;
            showCurrentStep();
            updateProgress();
          }
  
          // Log answers (for debugging or storing)
          console.log({ cookingSkill, foodPreference, cookingTime });
        });
      });
    });
  
    // Initialize the first step
    showCurrentStep();
    updateProgress();
  });
  
  