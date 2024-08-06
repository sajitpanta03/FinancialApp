<section class="page-contain">
  <a href="#" class="data-card">
    <h4>Total Goals Amount</h4>
    <h3><?php echo $getUserGoalsTotal; ?></h3>
    <p>Aenean lacinia bibendum nulla sed consectetur.</p>
  </a>
  <a href="#" class="data-card">
    <h4>Total Budget Amount</h4>
    <h3><?php echo $getUserBudgetsTotal; ?></h3>
    <p>Aenean lacinia bibendum nulla sed consectetur.</p>
  </a>
  <a href="#" class="data-card">
  <h4>Total Incomes Amount</h4>
    <h3><?php echo $getUserIncomesTotal; ?></h3>
    <p>Etiam porta sem malesuada.</p>
  </a>
</section>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@600;700&display=swap');


.page-contain {
  display: flex;
  min-height: 40px;
  align-items: center;
  justify-content: center;
  border: .75em solid white;
  padding: 2em;
  font-family: 'Open Sans', sans-serif;
}

.data-card {
  display: flex;
  flex-direction: column;
  height: 30%;
  width: auto;
  overflow: hidden;
  border-radius: .5em;
  text-decoration: none;
  background: white;
  margin: 1em;
  padding: 2.75em 2.5em;
  box-shadow: 0 1.5em 2.5em -.5em rgba(#000000, .1);
  transition: transform .45s ease, background .45s ease;

  h3 {
    color: #2E3C40;
    font-size: 2.5em;
    font-weight: 600;
    line-height: 1;
    padding-bottom: .5em;
    margin: 0 0 0.142857143em;
    border-bottom: 2px solid #753BBD;
    transition: color .45s ease, border .45s ease;
  }

  h4 {
    color: #627084;
    text-transform: uppercase;
    font-size: 1.125em;
    font-weight: 700;
    line-height: 1;
    letter-spacing: 0.1em;
    margin: 0 0 1.777777778em;
    transition: color .45s ease;
  }

  p {
    opacity: 0;
    color: #FFFFFF;
    font-weight: 600;
    line-height: 1.8;
    margin: 0 0 1.25em;
    transform: translateY(-1em);
    transition: opacity .45s ease, transform .5s ease;
  }

  .link-text {
    display: block;
    color: #753BBD;
    font-size: 1.125em;
    font-weight: 600;
    line-height: 1.2;
    margin: auto 0 0;
    transition: color .45s ease;

    svg {
      margin-left: .5em;
      transition: transform .6s ease;

      path {
        transition: fill .45s ease;
      }
    }
  }

  &:hover {
    background: #753BBD;
    transform: scale(1.02);

    h3 {
      color: #FFFFFF;
      border-bottom-color: #A754C4;
    }

    h4 {
      color: #FFFFFF;
    }

    p {
      opacity: 1;
      transform: none;
    }

    .link-text {
      color: #FFFFFF;

      svg {
        animation: point 1.25s infinite alternate;

        path {
          fill: #FFFFFF;
        }
      }
    }
  }
}

@keyframes point {
  0% {
   transform: translateX(0);
  }
  100% {
    transform: translateX(.125em);
  }
}
</style>
