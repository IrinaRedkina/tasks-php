<footer class="site-footer text-center">
    <div class="container">
      <p><a href="mailto:taffyself@gmail.com">taffyself@gmail.com</a></p>
    </div>
  </footer>

  <script>
    const taskList = document.querySelector('.tasks-list')

    taskList.addEventListener('click', (evt) => {
      const id = evt.target.getAttribute('data-id')

      if (!id) { return false }

      fetch('/tasks/completed/' + id, {
        method: 'POST',
        body: id
      })
    })
  </script>
</body>
</html>