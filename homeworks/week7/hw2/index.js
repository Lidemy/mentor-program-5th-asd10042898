document.querySelector('.faq-block').addEventListener('click', (e) => {
/* console.log(e.target) or console.log(e.currentTarget) 確定取的元素是甚麼, 差別在於 target 取的是點的東西, currentTarget 取的是加上 addEventListener 的元素 */
  const element = e.target.closest('.faq-item')
  if (element) {
    element.classList.toggle('faq-item__hide')
  }/* 這部分取元素的方法老師還有教另外兩種方法在影片中 */
})
