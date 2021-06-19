document.querySelector('.add-btn').addEventListener('click', () => {
  /* eslint-disable semi */
  const content = document.querySelector('.input-todo').value;
  if (!content) return
  const div = document.createElement('div')
  div.classList.add('todo')
  div.innerHTML = `
  <input class="todo__check" type="checkbox" />
  <div class="todo__title">${escapeHtml(content)}</div>
  <button class="del-btn">刪除</button>
  `
  document.querySelector('.todos').appendChild(div)
  document.querySelector('.input-todo').value = ''/* 清空輸入格的文字 */
})
/* event delegation / proxy */
document.querySelector('.todos').addEventListener('click', (event) => {
  const { target } = event
  /* delete todo */
  if (target.classList.contains('del-btn')) {
    target.parentNode.remove()/* 找到 todo 去刪掉他 */
    return
  }
  /* check/uncheck todo */
  if (target.classList.contains('todo__check')) {
    if (target.checked) {
      target.parentNode.classList.add('done')
    } else {
      target.parentNode.classList.remove('done')
    }
  }
})

function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, '$amp;')
    .replace(/</g, '$lt;')
    .replace(/>/g, '$gt;')
    .replace(/"/g, '$quot;')
    .replace(/'/g, '$#039;')
}
