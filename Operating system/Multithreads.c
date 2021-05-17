#include<stdio.h>
#include<stdlib.h>
#include<pthread.h>
#include<unistd.h>
#define NUM_THREAD 3


int counter = 1;
pthread_t thread_t[NUM_THREAD];
pthread_mutex_t lock;

void* funcThread (void* itr)
{

//  printf("\n\nBefore lock: %d\n", itr);
    
  pthread_mutex_lock(&lock);  
  
    //critical section
      if(itr == 0){
          printf("Thread 1 (Addition):\n");
          counter += 5;
          printf("After add 5, counter now: %d\n", counter);
          counter += 1;
          printf("After add 1, counter now: %d\n", counter);
          counter += 2;
          printf("After add 2, counter now: %d\n", counter);

      }
      if(itr == 1){
          printf("\n\nThread 2 (Subtraction):\n");
          counter -= 2;
          printf("After minus 2, counter now: %d\n", counter);
          counter -= 4;
          printf("After minus 4, counter now: %d\n", counter);
      }
      if(itr == 2){
          printf("\n\nThread 3 (Multiplication):\n");
          counter *= 10;
          printf("After times 10, counter now: %d\n", counter);
          counter *= 5;
          printf("After times 5, counter now: %d\n", counter);
      }

    //cs end
    pthread_mutex_unlock(&lock);

}


 


int main (){
  int i;
  int error;
  if(pthread_mutex_init(&lock, NULL) != 0){
      printf("Mutex init failed...");
      return 1;
  }
  
  printf ("\nCreating thread...\n");
  for(i=0; i<NUM_THREAD; i++){
      error = pthread_create (&thread_t[i], NULL, &funcThread, i);
      if(error != 0){
          printf("\nThread ID failed: %d", i);
      }
      pthread_join(thread_t[i], NULL);
  }
  
  pthread_mutex_destroy(&lock);

  return 0;
}
