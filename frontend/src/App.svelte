<script>
  import { onMount } from "svelte";
  import MainComponent from "./lib/MainComponent.svelte";
  import app from "./main";

  const StyleStorage = "IsXpStyle";
  let styleXp = true;

  let component;
  let styles = {
    Windowsxp: () => import("xp.css/dist/XP.css"),
    Windows98: () => import("xp.css/dist/98.css"),
  };

  onMount(() => {
    styleXp = localStorage.getItem(StyleStorage) === "true";

    if (styleXp) {
      component = styles.Windowsxp;
      document.body.classList.add("xp-bg");
    } else {
      component = styles.Windows98;
      document.body.classList.add("windows-bg");
    }

    component.apply();
  });

  function changeStyle() {
    styleXp = !styleXp;

    localStorage.setItem(StyleStorage, styleXp.toString());

    location.reload();
  }
</script>

<main>
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <button on:click={changeStyle}>Downgrade</button>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="window window-size">
          <div class="title-bar">
            <div class="title-bar-text">My First Program</div>
            <div class="title-bar-controls">
              <button aria-label="Minimize" />
              <button aria-label="Maximize" />
              <button aria-label="Close" />
            </div>
          </div>
          <div class="window-body">
            <p>Hello, world!</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<style>
  .window-size
  {
    height: 70vh;
    width: 70vw;
  }
</style>