<script>
  import { flip } from "svelte/animate";

  export let chrashed = false;

  function typewriter(node, { speed = 1 }) {
    const valid =
      node.childNodes.length === 1 &&
      node.childNodes[0].nodeType === Node.TEXT_NODE;

    if (!valid) {
      throw new Error(
        `This transition only works on elements with a single text node child`
      );
    }

    const text = node.textContent;
    const duration = text.length / (speed * 0.1);

    return {
      duration,
      tick: (t) => {
        const i = Math.trunc(text.length * t);
        node.textContent = text.slice(0, i);
      },
    };
  }

  function onKeyDown() {
    chrashed = false;
  }
</script>
<svelte:window on:keydown|preventDefault={onKeyDown} />
<pre class="blue-bg" in:typewriter>

                              System Error

    A fatal exception 0E76534801 has occured at 0027:C871231 in VXD VMM.
    Operating system has been stopped to prevent damage to your computer.

       *  Press any key to terminate this application.
       *  Press CTRL+ALT+DELETE to restart your computer.
          You will lose any unsaved information in all applications.

                      Press any key to continue</pre>
<style>
  .blue-bg {
    background-color: blue;
    text-align: left;
    font-size: 28px;
    box-shadow: none;
    color: white;
  }

  @keyframes flickerAnimation {
  0%   { opacity:1; }
  100% { opacity:0; }
}
@-o-keyframes flickerAnimation{
  0%   { opacity:1; }
  100% { opacity:0; }
}
@-moz-keyframes flickerAnimation{
  0%   { opacity:1; }
  100% { opacity:0; }
}
@-webkit-keyframes flickerAnimation{
  0%   { opacity:1; }
  100% { opacity:0; }
}
.animate-flicker {
   -webkit-animation: flickerAnimation 0.7s infinite;
   -moz-animation: flickerAnimation 0.7s infinite;
   -o-animation: flickerAnimation 0.7s infinite;
    animation: flickerAnimation 0.7s infinite;
}
</style>
